// Mendapatkan elemen dropdown
var dropdown = document.querySelector(".dropdown");

// Mendapatkan elemen dropdown-content
var dropdownContent = document.querySelector(".dropdown-content");

// Menambahkan event listener pada elemen dropdown
dropdown.addEventListener("click", function() {
  
  // Menampilkan atau menyembunyikan konten dropdown saat diklik
  if (dropdownContent.style.display === "none") {
    dropdownContent.style.display = "block";
  } else {
    dropdownContent.style.display = "none";
  }
});
