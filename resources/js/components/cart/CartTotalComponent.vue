<template>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th colspan="2">Итого</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Товаров</td>
                <td>{{ cart.totalCount }}</td>
            </tr>
            <tr>
                <td><b>К оплате</b></td>
                <td><b>₴ {{ cart.totalPrice }}</b></td>
            </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
export default {
    data() {
        return {
            cart: this.$store.state,
        }
    },
}
</script>
