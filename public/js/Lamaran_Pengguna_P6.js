const form = document.getElementById("jobForm");
form.addEventListener("submit", function (e) {
// Note: inputs di view pakai attribute name (bukan id)
  const fullNameEl = document.querySelector('input[name="nama"]');
  const positionEl = document.querySelector('select[name="posisi"]');
  const portfolioEl = document.querySelector('input[name="portfolio"]');
  const coverLetterEl = document.querySelector('textarea[name="cover"]');

  const emailEl = document.querySelector('input[name="email"]');
  const hpEl = document.querySelector('input[name="hp"]');
  const email = emailEl?.value?.trim() || "";
  const hp = hpEl?.value?.trim() || "";
  const fullName = fullNameEl?.value?.trim() || "";
  const position = positionEl?.value?.trim() || "";
  const portfolio = portfolioEl?.value?.trim() || "";
  const coverLetter = coverLetterEl?.value?.trim() || "";
  // Email validation (existing)
  if (!email.includes("@")) {
    e.preventDefault();
    alert("Email tidak valid!");
    return;
  }
  // HP validation (existing)
  // Accept digits only; prevents characters/spaces.
  if (hp.length === 0 || !/^\d+$/.test(hp)) {
    e.preventDefault();
    alert("Nomor HP harus angka!");
    return;
  }
  // Full name validation (added)
  if (fullName.length === 0) {
    e.preventDefault();
    alert("Nama lengkap tidak boleh kosong!");
    return;
  }
  // Prevent invalid characters and numbers in full name.
  // Allows letters, spaces, dot, apostrophe, hyphen.
  if (!/^[A-Za-zÀ-ÖØ-öø-ÿ\s.'-]+$/.test(fullName)) {
    e.preventDefault();
    alert("Nama lengkap hanya boleh huruf (tanpa angka/simbol).");
    return;
  }
  // Position validation (added)
  if (position.length === 0) {
    e.preventDefault();
    alert("Posisi tidak boleh kosong!");
    return;
  }
  // Portfolio validation (added)
  // If it is an input[type="file"], its value is usually a path/filename.
  // We validate presence + basic URL/file name heuristics.
  if (portfolio.length === 0) {
    e.preventDefault();
    alert("Portofolio tidak boleh kosong!");
    return;
  }
  // If portfolio looks like a URL, require http(s) format.
  // Otherwise allow a file name / non-empty string.
  if (/^https?:\/\//i.test(portfolio) === false && /\./.test(portfolio) === true) {
    // likely a filename; ok
  } else if (/^https?:\/\//i.test(portfolio) === false && !/^[A-Za-z0-9_./-]+$/.test(portfolio)) {
    e.preventDefault();
    alert("Portofolio tidak valid. Masukkan URL (https://...) atau nama file yang benar.");
    return;
  }
  // Cover letter validation (added)
  if (coverLetter.length === 0) {
    e.preventDefault();
    alert("Cover letter tidak boleh kosong!");
    return;
  }
  // Basic prevention: disallow only-whitespace and keep a minimum length.
  if (coverLetter.length < 1) {
    e.preventDefault();
    alert("Cover letter terlalu singkat (minimal 1 karakter). ");
    return;
  }
});
