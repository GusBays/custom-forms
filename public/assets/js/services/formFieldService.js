import Api from "../utils/api.js"
import Toast from "../utils/toast.js"

const api = new Api('form-fields')

const divFieldsGroup = document.querySelectorAll('#group-field-content')
const fieldsIdInput = document.querySelectorAll('#field-id')
const fieldsNameInput = document.querySelectorAll('#field-name')
const fieldsDescriptionInput = document.querySelectorAll('#field-description')
const fieldsTypeInput = document.querySelectorAll('#field-type')
const fieldsRequiredInput = document.querySelectorAll('#field-required')
const fieldsContentOptions = document.querySelectorAll('#field-content')

const addFieldButton = document.getElementById('add-field')

const deleteButtons = document.querySelectorAll('#delete-field')

$('document').ready(function() {
    Array.from(fieldsTypeInput).forEach(element => {
        let type = element.options[element.selectedIndex].value
        let content = Array.from(divFieldsGroup).find(content => content.dataset.fieldId === element.dataset.fieldId)
        if ('text' === type || 'blocked' === type) content.hidden = true
        else content.hidden = false
    })
})

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
    
        const requiredInput = Array.from(fieldsRequiredInput).find(byId)
        requiredInput.addEventListener('change', () => requiredInput.checked ? fieldData.required = true : fieldData.required = false)

        const contentInputs = Array.from(fieldsContentOptions).filter(byId)
        contentInputs.forEach(element => element.addEventListener('input', () => {
            fieldData.content = contentInputs.map(element => element.value)
        }))

        const typeInput = Array.from(fieldsTypeInput).find(byId)
        typeInput.addEventListener('change', () => {
            fieldData.type = typeInput.options[typeInput.selectedIndex].value
            const divGroup = Array.from(divFieldsGroup).find(byId)
            if ('text' === fieldData.type || 'blocked' === fieldData.type) divGroup.hidden = true
            else divGroup.hidden = false
        })

        const deleteButton = Array.from(deleteButtons).find(byId)
        deleteButton.addEventListener('click', () => {
            api.delete(deleteButton.dataset.fieldId)
            .then(res => {
                if (!res.ok) throw Error(res.statusText)
                else window.location.reload()
            })
            .catch(e => {
                return new Toast()
                    .show('Ocorreu um erro ao deletar o campo, tente novamente.')
            })
        })

        formFields.push(fieldData)
    }

    return formFields
}