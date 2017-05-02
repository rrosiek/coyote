import Clipboard from 'clipboard'

export default {
    bind (el, binding) {
        let text = el.innerHTML
        let clipboard = new Clipboard(el, {
            text: () => binding.value.text
        })

        clipboard.on('success', e => {
            el.innerHTML = 'Copied!'
            e.clearSelection()

            setTimeout(() => {
                el.innerHTML = text
            }, 1200)
        })
    }
}
