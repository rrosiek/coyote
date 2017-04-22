export default {
    bind (el) {
        el.addEventListener('click', () => {
            el.parentNode.style.display = 'none'
        }, false)
    }
}