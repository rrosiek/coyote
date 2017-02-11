export default {
    bind (el, binding) {
        el.addEventListener('click', e => {
            e.preventDefault()

            document.getElementById(binding.value.id).scrollIntoView()
        }, false)
    }
}
