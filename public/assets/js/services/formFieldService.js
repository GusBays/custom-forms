import Api from "../utils/api.js"
import Toast from "../utils/toast.js"

const api = new Api('form-fields')

$('document').ready(function() {
    Array.from(fieldsTypeInput).forEach(element => {
        let type = element.options[element.selectedIndex].value
        let content = Array.from(divFieldsGroup).find(content => content.dataset.fieldId === element.dataset.fieldId)
        if ('text' === type || 'blocked' === type) content.hidden = true
        else content.hidden = false
    })
})

const divFieldsGroup = document.querySelectorAll('#group-field-content')
const fieldsIdInput = document.querySelectorAll('#field-id')
const fieldsNameInput = document.querySelectorAll('#field-name')
const fieldsDescriptionInput = document.querySelectorAll('#field-description')
const fieldsTypeInput = document.querySelectorAll('#field-type')
const fieldsRequiredInput = document.querySelectorAll('#field-required')
const fieldsContentOptions = document.querySelectorAll('#field-content')
const addOptionsButton = document.querySelectorAll('#add-option')
const deleteOptionButtons = document.querySelectorAll('#delete-option')
const deleteButtons = document.querySelectorAll('#delete-field')
const addFieldButton = document.getElementById('add-field')

const formFieldsToCreate = []

addFieldButton.addEventListener('click', () => {
    const newFieldDiv = document.createElement('div')
    newFieldDiv.classList.add(...['border-bottom','mb-3'])
    const newFieldInputs = `
        <input type="text" id="field-id" value="${null}" hidden>
        <div class="mb-3">
            <label for="name" class="form-label">Nome do campo</label>
            <input type="text" class="form-control" id="field-name" data-field-id=${null}>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrição do campo</label>
            <textarea class="form-control text-top description-input" id="field-description" data-field-id=${null}></textarea>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipo</label>
            <select id="field-type" class="form-select" data-field-id="${null}">
                <option value="text">Texto</option>
                <option value="checkbox">Checkbox</option>
                <option value="select">Seletor</option>
                <option value="blocked">Bloqueado</option>
            </select>
        </div>
        <div class="form-check form-switch align-self-center mb-3">
            <label for="active" class="form-label">Obrigatório</label>
            <input class="form-check-input active-switch" id="field-required" value="${null}" type="checkbox" role="switch" data-field-id=${null}>
        </div>
        <div class="mb-3 p-2 rounded" style="background-color: #e9ecef;" id="group-field-content" data-field-id="${null}" hidden>
            <label for="content" class="form-label">Opções</label>
            <button class="btn btn-success" id="add-option" data-field-id="${null}"><img src="${window.origin}/assets/img/add-icon.svg" width="25" height="25" alt="add-icon"></button>
        </div>
        <div class="mb-3">
            <button class="btn btn-danger" id="delete-field" data-field-id="${null}">Deletar campo</button>
        </div>
    `

    newFieldDiv.innerHTML = newFieldInputs
    const parent = document.getElementById('fields')
    parent.insertBefore(newFieldDiv, addFieldButton)

    const formIdInput = document.getElementById('id')
    let formId = null
    if (formIdInput) formId = formIdInput.value

    const newFieldObj = {
        id: null,
        form_id: formId,
        type: 'text',
        required: false,
        content: []
    }

    formFieldsToCreate.push(newFieldObj)
    const indexOfNewField = formFieldsToCreate.indexOf(newFieldObj)

    const newFieldNameInput = newFieldDiv.children[1].lastElementChild
    newFieldNameInput.addEventListener('input', () => formFieldsToCreate[indexOfNewField].name = newFieldNameInput.value)

    const newFieldDescriptionInput = newFieldDiv.children[2].lastElementChild
    newFieldDescriptionInput.addEventListener('input', () => formFieldsToCreate[indexOfNewField].description = newFieldDescriptionInput.value)

    const newFieldTypeInput = newFieldDiv.children[3].lastElementChild
    newFieldTypeInput.addEventListener('change', () => {
        formFieldsToCreate[indexOfNewField].type = newFieldTypeInput.options[newFieldTypeInput.selectedIndex].value
        if ('text' === formFieldsToCreate[indexOfNewField].type || 'blocked' === formFieldsToCreate[indexOfNewField].type) newFieldContentGroup.hidden = true
        else newFieldContentGroup.hidden = false
    })

    const newFieldRequiredInput = newFieldDiv.children[4]
    newFieldRequiredInput.addEventListener('change', () => newFieldRequiredInput.checked ? formFieldsToCreate[indexOfNewField].required = true : formFieldsToCreate[indexOfNewField].required = false)

    const newFieldContentGroup = newFieldDiv.children[5]

    const newFieldAddOptionButton = newFieldDiv.children[5].lastElementChild
    newFieldAddOptionButton.addEventListener('click', () => {
        const newOptionDiv = document.createElement('div')
        newOptionDiv.classList.add(...['input-group','mb-1'])
        const optionInput = `
            <input type="text" class="form-control" id="field-content" data-field-id="${null}">
            <button class="input-group-text btn btn-danger"><img src="${window.location.origin}/assets/img/trash-icon.svg" width="25" height="32"></button>
        `
        newOptionDiv.innerHTML = optionInput
        newFieldContentGroup.insertBefore(newOptionDiv, newFieldAddOptionButton)
        const input = newOptionDiv.firstElementChild
        input.addEventListener('input', () => {
            const byTagName = (element) => element.tagName === "INPUT"
            const contentInputs = Array.from(newFieldContentGroup.children).filter(byTagName)
            formFieldsToCreate[indexOfNewField].content = contentInputs.map(element => element.value)
            formFieldsToCreate[indexOfNewField].content.push(input.value)
        })
        const deleteNewOptionButton = newOptionDiv.lastElementChild
        deleteNewOptionButton.addEventListener('click', () => {
            const input = deleteNewOptionButton.parentElement.firstElementChild
            formFieldsToCreate[indexOfNewField].content = contentInputs.map(element => {
                if (element.value === input.value) return;
                return element.value
            }).filter(element => element != null)
            deleteNewOptionButton.parentElement.remove()
        })
    })

    const newFieldDeleteButton = newFieldDiv.children[6].firstElementChild
    newFieldDeleteButton.addEventListener('click', () => {
        formFieldsToCreate.splice(indexOfNewField, 1)
        newFieldDiv.remove()
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

        const divFieldContent = Array.from(divFieldsGroup).find(byId)

        const typeInput = Array.from(fieldsTypeInput).find(byId)
        typeInput.addEventListener('change', () => {
            fieldData.type = typeInput.options[typeInput.selectedIndex].value
            if ('text' === fieldData.type || 'blocked' === fieldData.type) divFieldContent.hidden = true
            else divFieldContent.hidden = false
        })

        const addOptionButton = Array.from(addOptionsButton).find(byId)
        addOptionButton.addEventListener('click', () => {
            const newOptionDiv = document.createElement('div')
            newOptionDiv.classList.add(...['input-group','mb-1'])
            const optionInput = `
                <input type="text" class="form-control" id="field-content" data-field-id="${idInput.value}">
                <button class="input-group-text btn btn-danger"><img src="${window.location.origin}/assets/img/trash-icon.svg" width="25" height="32"></button>
            `
            newOptionDiv.innerHTML = optionInput
            divFieldContent.insertBefore(newOptionDiv, addOptionButton)
            const input = newOptionDiv.firstElementChild
            input.addEventListener('input', () => {
                fieldData.content = contentInputs.map(element => element.value)
                fieldData.content.push(input.value)
            })
            const deleteNewOptionButton = newOptionDiv.lastElementChild
            deleteNewOptionButton.addEventListener('click', () => {
                const input = deleteNewOptionButton.parentElement.firstElementChild
                fieldData.content = contentInputs.map(element => {
                    if (element.value === input.value) return;
                    return element.value
                }).filter(element => element != null)
                deleteNewOptionButton.parentElement.remove()
            })
        })

        const deleteOptionButton = Array.from(deleteOptionButtons).filter(byId)
        deleteOptionButton.forEach(deleteOption => {
            deleteOption.addEventListener('click', () => {
                const input = deleteOption.parentElement.firstElementChild
                fieldData.content = contentInputs.map(element => {
                    if (element.value === input.value) return;
                    return element.value
                }).filter(element => element != null)
                deleteOption.parentElement.remove()
            })
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

export function createNewFields() {
    for (const field of formFieldsToCreate) {
        api.post(field)
        .then(res => {
            if (!res.ok) throw Error(res.statusText)
        }).catch(e => {
            return new Toast()
                .show('Ocorreu um erro ao criar o campo, tente novamente.')
        })
    }
}