export default {
    bind (el) {
        el.addEventListener('click', () => {
            el.classList.add('is-loading')
            el.classList.add('is-disabled')
        }, false)
    }
}
