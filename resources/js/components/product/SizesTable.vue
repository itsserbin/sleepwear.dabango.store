<template>
    <div>
        <div class="shop__delivery-info" style="margin-top: 30px ">
            <b-button
                v-b-modal="'modal-sizes'"
                id="sizes"
                class="shop__sizes-table d-flex"
                variant="btn">
                <span class="icon-table"></span>
                <span>Таблица размеров</span>
            </b-button>
        </div>

        <b-modal id="modal-sizes" title="Таблица размеров" class="modal-sizes modal" centered hide-footer>
            <b-form>
                <div class="modal-content">
                    <table v-if="this.sizeTable === 'null'" class="sizes-table">
                        <tr>
                            <th>Размеры</th>
                            <th>Чашка</th>
                            <th>Объем груди</th>
                            <th>Объем бедер</th>
                        </tr>
                        <tr>
                            <th>S</th>
                            <td>A-B</td>
                            <td>82-85</td>
                            <td>85-90</td>
                        </tr>
                        <tr>
                            <th>M</th>
                            <td>B-C</td>
                            <td>86-89</td>
                            <td>91-95</td>
                        </tr>
                        <tr>
                            <th>L</th>
                            <td>C-D</td>
                            <td>90-93</td>
                            <td>96-100</td>
                        </tr>
                        <tr>
                            <th>XL</th>
                            <td>D-E</td>
                            <td>94-97</td>
                            <td>101-105</td>
                        </tr>
                        <tr>
                            <th>XXL</th>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                        </tr>
                    </table>
                    <div v-if="this.sizeTable !== 'null'" class="sizes-table">
                        <div v-html="sizeTable"></div>
                    </div>
                </div>
            </b-form>
        </b-modal>
    </div>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    props:{
        sizeTable: String,
    },
}
</script>
