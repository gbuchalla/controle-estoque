<template>

</template>

<script type="text/javascript">

export default {
    created() {
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        Toast.fire({
            icon: 'success',
            title: 'Logout feito com sucesso'
        })
        this.$router.push({ name: 'login' })

    }
}

</script>


