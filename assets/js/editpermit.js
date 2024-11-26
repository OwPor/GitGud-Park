const fileInput = document.getElementById('fplogo');
const uploadedFilesContainer = document.getElementById('uploaded-files');
const maxFiles = 5;
let totalFileCount = 0; // Track total files (existing + new)

// Sample existing files fetched from the server
const existingFiles = [
    { name: "permit1.pdf", url: "/path/to/permit1.pdf" },
    { name: "permit2.jpg", url: "/path/to/permit2.jpg" }
];

// Function to display a file entry
function createFileEntry(file, isExisting = false) {
    const fileEntry = document.createElement('div');
    fileEntry.classList.add('uploaded-file');
    fileEntry.style.display = 'flex';
    fileEntry.style.alignItems = 'center';
    fileEntry.style.justifyContent = 'space-between';
    fileEntry.style.marginBottom = '10px';

    // Check icon for successful upload
    const checkIcon = document.createElement('i');
    checkIcon.className = 'fa-solid fa-circle-check icon-btn';
    checkIcon.style.color = 'green';
    checkIcon.style.marginRight = '8px';

    // File name (linked if existing)
    const fileName = isExisting ? document.createElement('a') : document.createElement('span');
    fileName.textContent = file.name;
    fileName.classList.add('file-name');
    fileName.style.flexGrow = '1';
    if (isExisting) {
        fileName.href = file.url; // Link for existing files
        fileName.target = "_blank"; // Open in a new tab
    }

    // Delete icon to remove the file
    const deleteIcon = document.createElement('i');
    deleteIcon.className = 'fa-regular fa-trash-can icon-btn';
    deleteIcon.style.color = 'red';
    deleteIcon.style.marginLeft = '8px';
    deleteIcon.onclick = () => {
        fileEntry.remove();
        totalFileCount--;
    };

    // Append elements to the file entry
    fileEntry.appendChild(checkIcon);
    fileEntry.appendChild(fileName);
    fileEntry.appendChild(deleteIcon);
    uploadedFilesContainer.appendChild(fileEntry);
}

// Load existing files into the same container
function loadExistingFiles() {
    existingFiles.forEach(file => {
        createFileEntry(file, true); // Pass `true` to indicate it's an existing file
        totalFileCount++;
    });
}

// Handle new uploads
fileInput.addEventListener('change', () => {
    const newFiles = Array.from(fileInput.files);

    // Check if total file count exceeds the maximum allowed
    if (totalFileCount + newFiles.length > maxFiles) {
        alert(`You can upload a maximum of ${maxFiles} files.`);
        fileInput.value = ""; // Clear input
        return;
    }

    // Display new uploaded files
    newFiles.forEach(file => {
        createFileEntry(file); // `isExisting` defaults to `false`
        totalFileCount++;
    });

    fileInput.value = ""; // Reset file input
});

// Trigger file input when clicking the upload section
document.querySelector('.logocon').addEventListener('click', () => fileInput.click());

// Load existing files on page load
loadExistingFiles();