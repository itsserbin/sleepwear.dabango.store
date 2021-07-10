<template>
    <div class="shop__available-sizes available-sizes">
        <div class="shop__available-sizes__label w-100 mb-2">Доступные размеры:</div>

        <div v-if="this.xs !== 'null'" class="size__element me-1 mb-2">
            <label class="mycheckbox">
                <input name="sizes[]" value="xs" class="mycheckbox__default"
                       type="checkbox" disabled>
                <span class="mycheckbox__new">XS</span>
                <span class="mycheckbox__descr"></span>
            </label>
        </div>

        <div v-if="this.s !== 'null'" class="size__element me-1 mb-2">
            <label class="mycheckbox">
                <input name="sizes[]" value="s" class="mycheckbox__default"
                       type="checkbox" disabled>
                <span class="mycheckbox__new">S</span>
                <span class="mycheckbox__descr"></span>
            </label>
        </div>

        <div v-if="this.m !== 'null'" class="size__element me-1 mb-2">
            <label class="mycheckbox">
                <input name="sizes[]" value="m" class="mycheckbox__default"
                       type="checkbox" disabled>
                <span class="mycheckbox__new">M</span>
                <span class="mycheckbox__descr"></span>
            </label>
        </div>

        <div v-if="this.l !== 'null'" class="size__element me-1 mb-2">
            <label class="mycheckbox">
                <input name="sizes[]" value="l" class="mycheckbox__default"
                       type="checkbox" disabled>
                <span class="mycheckbox__new">L</span>
                <span class="mycheckbox__descr"></span>
            </label>
        </div>

        <div v-if="this.xl !== 'null'" class="size__element me-1 mb-2">
            <label class="mycheckbox">
                <input name="sizes[]" value="xl" class="mycheckbox__default"
                       type="checkbox" disabled>
                <span class="mycheckbox__new">XL</span>
                <span class="mycheckbox__descr"></span>
            </label>
        </div>

        <div v-if="this.xxl !== 'null'" class="size__element me-1 mb-2">
            <label class="mycheckbox">
                <input name="sizes[]" value="xxl" class="mycheckbox__default"
                       type="checkbox" disabled>
                <span class="mycheckbox__new">XXL</span>
                <span class="mycheckbox__descr"></span>
            </label>

        </div>

        <div v-if="this.xxxl !== 'null'" class="size__element me-1 mb-2">
            <label class="mycheckbox">
                <input name="sizes[]" value="xxxl" class="mycheckbox__default"
                       type="checkbox" disabled>
                <span class="mycheckbox__new">XXXL</span>
                <span class="mycheckbox__descr"></span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        xs: String,
        s: String,
        m: String,
        l: String,
        xl: String,
        xxl: String,
        xxxl: String,
    },
}
</script>
