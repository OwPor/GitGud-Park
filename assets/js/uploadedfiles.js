const fileInput = document.getElementById('fplogo');
const uploadedFilesContainer = document.getElementById('uploaded-files');
const maxFiles = 5;
let uploadedFileCount = 0; 
let uploadedFiles = [];

document.querySelector('.logocon').addEventListener('click', () => fileInput.click());

fileInput.addEventListener('change', () => {
    const newFiles = Array.from(fileInput.files);
    if (uploadedFileCount + newFiles.length > maxFiles) {
        alert(`You can upload a maximum of ${maxFiles} files.`);
        return;
    }

    newFiles.forEach((file) => {
        uploadedFiles.push(file);

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
            fileEntry.remove();
            uploadedFileCount--; 
            uploadedFiles = uploadedFiles.filter(f => f.name !== file.name);
        };

        fileEntry.appendChild(checkIcon);
        fileEntry.appendChild(fileName);
        fileEntry.appendChild(deleteIcon);
        uploadedFilesContainer.appendChild(fileEntry);
    });

    uploadedFileCount += newFiles.length;
});