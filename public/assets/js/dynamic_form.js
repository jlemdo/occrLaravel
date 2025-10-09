// Drag start
document.querySelectorAll('.draggable').forEach(button => {
  button.addEventListener('dragstart', function (e) {
    e.dataTransfer.setData('field', e.target.dataset.field);
    e.dataTransfer.setData('type', e.target.dataset.type);
    e.dataTransfer.setData('label', e.target.innerText);
  });
});

document.getElementById('right-zone').addEventListener('dragover', function (e) {
  e.preventDefault();
});

// Drop functionality
document.getElementById('right-zone').addEventListener('drop', function (e) {
  e.preventDefault();

  const field = e.dataTransfer.getData('field'); // Field type (e.g., h1, h2)
  const type = e.dataTransfer.getData('type');   // Element type (e.g., heading, input)
  const label = e.dataTransfer.getData('label'); // Label for the field

  const form = document.getElementById('dynamic-form');
  const formGroup = document.createElement('div');
  formGroup.classList.add('form-group');

  let inputField;

  if (type === 'heading') {
    const heading = document.createElement(field);
    heading.innerText = label;
    heading.setAttribute('contenteditable', 'true');
    heading.classList.add('editable-heading');
    formGroup.appendChild(heading);
  } else if (type === 'input') {
    const inputLabel = document.createElement('label');
    inputLabel.innerText = label;
    formGroup.appendChild(inputLabel);

    inputField = document.createElement('input');
    inputField.type = field === 'email' ? 'email' : 'text';
    inputField.name = field;
    inputField.classList.add('form-control');
    if (field === 'date') inputField.classList.add('date-picker');
  } else if (type === 'checkbox' || type === 'radio') {
    const optionsContainer = document.createElement('div');
    optionsContainer.classList.add('options-container');

    const uniqueName = `group-${Date.now()}`; // Unique name for group

    const addOption = (value = 'Option') => {
      const optionWrapper = document.createElement('div');
      optionWrapper.classList.add('option-wrapper');

      const inputOption = document.createElement('input');
      inputOption.type = type;
      inputOption.name = type === 'radio' ? uniqueName : field;

      const optionLabel = document.createElement('label');
      optionLabel.textContent = value;
      optionLabel.setAttribute('contenteditable', 'true');
      optionLabel.classList.add(`editable-${type}-label`);

      const removeButton = document.createElement('button');
      removeButton.innerHTML = '❌';
      removeButton.classList.add('remove-option');
      removeButton.addEventListener('click', () => optionWrapper.remove());

      optionWrapper.appendChild(inputOption);
      optionWrapper.appendChild(optionLabel);
      optionWrapper.appendChild(removeButton);
      optionsContainer.appendChild(optionWrapper);
    };

    for (let i = 0; i < 4; i++) {
      addOption(`Option ${i + 1}`);
    }

    const addMoreButton = document.createElement('button');
    addMoreButton.innerText = 'Add Option';
    addMoreButton.type = 'button';
    addMoreButton.classList.add('add-option-btn');
    addMoreButton.addEventListener('click', () => {
      addOption(`Option ${optionsContainer.children.length + 1}`);
    });

    formGroup.appendChild(optionsContainer);
    formGroup.appendChild(addMoreButton);
  } else if (type === 'select') {
    const inputLabel = document.createElement('label');
    inputLabel.innerText = label;
    formGroup.appendChild(inputLabel);

    inputField = document.createElement('select');
    inputField.classList.add('form-control');
    ['Option 1', 'Option 2', 'Option 3'].forEach(optionText => {
      const option = document.createElement('option');
      option.value = optionText;
      option.innerText = optionText;
      inputField.appendChild(option);
    });
  } else if (type === 'textarea') {
    const inputLabel = document.createElement('label');
    inputLabel.innerText = label;
    formGroup.appendChild(inputLabel);

    inputField = document.createElement('textarea');
    inputField.classList.add('form-control');
    inputField.rows = 4;
  } else if (type === 'input' && field === 'phone') {  // For Phone Number
  const inputLabel = document.createElement('label');
  inputLabel.innerText = label;  // Setting label for the phone number field
  formGroup.appendChild(inputLabel);

  inputField = document.createElement('input');
  inputField.type = 'tel';  // Using 'tel' for phone numbers
  inputField.name = field;
  inputField.classList.add('form-control');
  inputField.placeholder = 'Enter phone number';  // Set meaningful placeholder text
  formGroup.appendChild(inputField);  // Append the phone input field to the form group
}

else if (type === 'type' && field === 'file') {
    const inputLabel = document.createElement('label');
    inputLabel.innerText = label;
    inputLabel.classList.add('file-label');
    formGroup.appendChild(inputLabel);

    // Create a file input
    inputField = document.createElement('input');
    inputField.type = 'file';
    inputField.accept = 'image/*';
    inputField.classList.add('form-control', 'file-input');

    const previewContainer = document.createElement('div');
    previewContainer.classList.add('image-preview-container');

    const imagePreview = document.createElement('img');
    imagePreview.classList.add('image-preview');
    imagePreview.style.display = 'none';
    previewContainer.appendChild(imagePreview);

    inputField.addEventListener('change', function (event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          imagePreview.src = e.target.result;
          imagePreview.style.display = 'block'; // Show the image preview
        };
        reader.readAsDataURL(file);
      }
    });

    formGroup.appendChild(inputField);
    formGroup.appendChild(previewContainer);
  }

  if (inputField) {
    formGroup.appendChild(inputField);
  }

  const removeFormGroupButton = document.createElement('span');
  removeFormGroupButton.innerHTML = '❌';
  removeFormGroupButton.classList.add('remove-btn');
  removeFormGroupButton.addEventListener('click', () => formGroup.remove());
  formGroup.appendChild(removeFormGroupButton);

  form.appendChild(formGroup);

  // Initialize date picker for the date fields
  $('.date-picker').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
  });
});

