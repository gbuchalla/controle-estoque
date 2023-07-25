<template>
    <div>
        <footer class="sticky-footer mt-auto bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    StockSimple Manager
                    <span>&copy; {{ date() }}
                        <!-- desenvolvido por <b> <a href="https://buchalla.dev" target = "_blank" > Guilherme B.Ferreira < /a></b > -->
                    </span>
                </div>
            </div>
        </footer>
    </div>

</template>

<script>
export default {
    methods: {
        date() {
            return new Date().getFullYear();
        }
    }
}
</script>