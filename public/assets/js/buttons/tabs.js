const tabs = document.querySelectorAll('[data-tab-value]')
const tabInfos = document.querySelectorAll('[data-tab-info]')

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(tab => {
            tab.classList.remove('active');
        })

        const tabData = document
            .querySelector(tab.dataset.tabValue);

        tabInfos.forEach(tabInfo => {
            tabInfo.classList.remove('active-tab')
        })

        tab.classList.add('active');
        tabData.classList.add('active-tab');
    })
})