window.onload = function () {
  jam();
  tanggalan();
}

function jam() {
  var e = document.getElementById('jam'),
    d = new Date(),
    h, m, s;
  h = d.getHours();
  m = set(d.getMinutes());
  s = set(d.getSeconds());

  e.innerHTML = h + ':' + m + ':' + s;
  setTimeout('jam()', 1000);
}

function tanggalan() {
  bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];
  var hari = ['Minggu', 'Senin', 'Selasa',
    'Rabu', 'Kamis', 'Jumat', 'Sabtu'
  ];
  var e = document.getElementById('tanggalan'),
    date = new Date(),
    h, d, m, y;
  h = date.getDay();
  d = date.getDate();
  m = date.getMonth();
  y = set(date.getFullYear());

  e.innerHTML = hari[h] + '    ' + d + ' / ' + bulan[m] + ' / ' + y;
}

function set(e) {
  e = e < 10 ? '0' + e : e;
  return e;
}