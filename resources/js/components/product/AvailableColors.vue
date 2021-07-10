<template>
    <div class="available-colors">
        <div class="available-colors__label w-100 mb-2">Доступные цвета:</div>
        <div v-for="item in colors" :key="item.id">
            <label class="mycheckbox" :style="'background-color:' + item.colors.hex ">
                <input name="colors[]" :value="item.colors.name" class="mycheckbox__default"
                       type="checkbox" disabled>
                <span class="mycheckbox__new"></span>
            </label>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            colors: []
        }
    },
    props:{
      id: String,
    },
    mounted() {
        axios.get('/api/product/colors/' + this.id)
            .then(({data}) => this.colors = data.result)
            .catch(({response}) => console.log(response));
    }
}
</script>
