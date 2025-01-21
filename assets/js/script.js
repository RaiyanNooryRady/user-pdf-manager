document.addEventListener("DOMContentLoaded", () => {
  const viewDocumentsBtn = document.getElementById("view-documents-btn");
  const pdfListContainer = document.getElementById("pdf-list-container");
  const pdfLinks = document.querySelectorAll(".pdf-link");
  const modal = document.getElementById("pdf-modal");
  const pdfViewer = document.getElementById("pdf-viewer");
  const closeModal = document.getElementById("close-modal");

  // Toggle PDF list visibility
  viewDocumentsBtn.addEventListener("click", () => {
    pdfListContainer.style.display = pdfListContainer.style.display === "none" ? "block" : "none";
  });

  // Show modal with PDF
  pdfLinks.forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();
      const pdfUrl = event.target.getAttribute("data-pdf");
      pdfViewer.src = pdfUrl;
      modal.style.display = "flex";
    });
  });

  // Close modal
  closeModal.addEventListener("click", () => {
    modal.style.display = "none";
    pdfViewer.src = ""; // Clear the iframe source
  });

  // Close modal when clicking outside the iframe
  modal.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
      pdfViewer.src = "";
    }
  });
});
