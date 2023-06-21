class Notification {

    success() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Operação realizada com sucesso!',
            timeout: 1000,
        }).show();
    }


    alert() {
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Você tem certeza?',
            timeout: 1000,
        }).show();
    }



    error() {
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Ops, algo deu errado',
            timeout: 1000,
        }).show();
    }


    warning() {
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Ops, algo deu errado',
            timeout: 1000,
        }).show();
    }



    image_validation() {
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: 'A imagem deve ter menos de 1MB ',
            timeout: 1000,
        }).show();
    }



    cart_success() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Add to Cart!',
            timeout: 1000,
        }).show();
    }


    cart_delete() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Deleted!',
            timeout: 1000,
        }).show();
    }



}

export default Notification = new Notification()