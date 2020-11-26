<template>
    <div>
        <div
            class="modal fade"
            :id="idmodal"
            tabindex="-1"
            :aria-labelledby="idmodal + 'ModalLabel'"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" :id="idmodal + 'ModalLabel'">
                            <slot name="header"></slot>
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <slot name="body"></slot>
                    </div>
                    <div class="modal-footer">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['idmodal'],
    data() {
        return {};
    }
};
</script>
