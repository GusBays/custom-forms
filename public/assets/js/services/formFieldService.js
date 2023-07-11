const fieldsIdInput = document.querySelectorAll('#field-id')
const fieldsNameInput = document.querySelectorAll('#field-name')
const fieldsDescriptionInput = document.querySelectorAll('#field-description')
const fieldsTypeInput = document.querySelectorAll('#field-type')
const fieldsRequiredInput = document.querySelectorAll('#field-required')

export function getFormFields() {
    const formFields = []

    for (let idInput of fieldsIdInput) {
        const fieldData = {}

        if (idInput.value && idInput.value !== '') fieldData.id = idInput.value

        const byId = (element) => element.dataset.fieldId === idInput.value
    
        const nameInput = Array.from(fieldsNameInput).find(byId)
        nameInput.addEventListener('input', () => fieldData.name = nameInput.value)
    
        const descriptionInput = Array.from(fieldsDescriptionInput).find(byId)
        descriptionInput.addEventListener('input', () => fieldData.description = descriptionInput.value)
    
        const typeInput = Array.from(fieldsTypeInput).find(byId)
        typeInput.addEventListener('input', () => fieldData.type = typeInput.value)
    
        const requiredInput = Array.from(fieldsRequiredInput).find(byId)
        requiredInput.addEventListener('change', () => requiredInput.checked ? fieldData.required = true : fieldData.required = false)
    
        formFields.push(fieldData)
    }

    return formFields
}