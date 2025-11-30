const puppeteer = require('puppeteer');
const fs = require('fs');
const path = require('path');

(async () => {
  const browser = await puppeteer.launch({ headless: true });
  const page = await browser.newPage();

  await page.goto('https://sipp.pn-negara.go.id/list_jadwal_sidang', { waitUntil: 'networkidle2' });
  await page.waitForSelector('table');

  const jadwals = await page.evaluate(() => {
    const rows = Array.from(document.querySelectorAll('table tbody tr'));
    return rows.map(row => {
      const cells = row.querySelectorAll('td');
      return {
        tanggal_sidang: cells[6]?.innerText.trim(),
        nomor_perkara:  cells[1]?.innerText.trim(),
        agenda:         cells[2]?.innerText.trim(),
        sidang_keliling: cells[3]?.innerText.trim(),
        ruangan:        cells[4]?.innerText.trim()
      };
    });
  });

  const filePath = path.join(__dirname, '../writable/jadwal_sidang.json');
  fs.writeFileSync(filePath, JSON.stringify(jadwals, null, 2));

  console.log('Data jadwal sidang berhasil disimpan di writable/jadwal_sidang.json');
  await browser.close();
})();
