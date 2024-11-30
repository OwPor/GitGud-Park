const fileInput = document.getElementById('fplogo');
const uploadedFilesContainer = document.getElementById('uploaded-files');
const maxFiles = 5;

document.querySelector('.logocon').addEventListener('click', () => fileInput.click());

fileInput.addEventListener('change', () => {
    // Clear the uploaded files container to refresh the UI
    uploadedFilesContainer.innerHTML = "";

    const newFiles = Array.from(fileInput.files);
    if (newFiles.length > maxFiles) {
        alert(`You can upload a maximum of ${maxFiles} files.`);
        fileInput.value = ""; // Reset input if too many files are selected
        return;
    }

    newFiles.forEach((file) => {
        const fileEntry = document.createElement('div');
        fileEntry.classList.add('uploaded-file');
        fileEntry.style.display = 'flex';
        fileEntry.style.alignItems = 'center';
        fileEntry.style.justifyContent = 'space-between';

        const checkIcon = document.createElement('i');
        checkIcon.className = 'fa-solid fa-circle-check icon-btn';
        checkIcon.style.color = 'green';
        checkIcon.style.marginRight = '8px';

        const fileName = document.createElement('span');
        fileName.textContent = file.name;
        fileName.classList.add('file-name');
        fileName.style.flexGrow = '1';

        const deleteIcon = document.createElement('i');
        deleteIcon.className = 'fa-regular fa-trash-can icon-btn';
        deleteIcon.style.color = 'red';
        deleteIcon.style.marginLeft = '8px';
        deleteIcon.onclick = () => {
            // Remove the file visually
            fileEntry.remove();

            // Update the file input (create a new DataTransfer object to hold the remaining files)
            const dataTransfer = new DataTransfer();
            Array.from(fileInput.files).forEach((currentFile) => {
                if (currentFile.name !== file.name) {
                    dataTransfer.items.add(currentFile);
                }
            });

            fileInput.files = dataTransfer.files; // Update the file input with the new list
        };

        fileEntry.appendChild(checkIcon);
        fileEntry.appendChild(fileName);
        fileEntry.appendChild(deleteIcon);
        uploadedFilesContainer.appendChild(fileEntry);
    });
});
