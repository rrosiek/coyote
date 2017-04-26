<div :class="{ 'is-active': showModal }" class="modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        {{ $slot }}
    </div>
    <button @click="showModal = false" class="modal-close">Close</button>
</div>