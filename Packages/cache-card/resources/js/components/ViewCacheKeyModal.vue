<template>
    <modal @modal-close="handleClose">
        <div
            class="bg-white rounded-lg shadow-lg overflow-hidden"
            style="width: 640px; max-width: 100%;"
        >
            <div class="p-8">
                <heading :level="2" class="mb-6"><strong>{{ this.cacheKey }}</strong></heading>
                <textarea class="bg-30 p-4 view-cache-value" readonly>{{ value }}</textarea>
            </div>

            <div class="bg-30 px-6 py-3 flex">
                <div class="ml-auto">
                   <button dusk="close-view-key-button" ref="confirmButton" data-testid="confirm-button" @click.prevent="handleConfirm" class="rounded btn btn-default btn-primary p-2 bg-primary-500 text-white">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
  name: "ViewCacheKeyModal",
  props: ['cacheKey', 'value'],

    mounted() {
      if(this.$refs?.confirmButton) {
        this.$refs.confirmButton.focus();
      }
    },

    methods: {
        handleConfirm() {
            this.$emit('confirm')
        },
    },
}
</script>
