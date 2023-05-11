<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{url('/dashboard')}}">Cobranças</a> / Cartão de Crédito
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form id="form-pay">
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}" />

                        <div class="row">

                            <div class="col-sm-6">
                                <h3><i class="fa fa-credit-card"></i> Cartão</h3>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="holderName" placeholder="Nome">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Número</label>
                                    <input type="text" class="form-control" name="number" placeholder="Número" value="4998 1800 6666 55555">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Expira em</label>
                                    <input type="text" class="form-control" name="expiry" placeholder="mm/aaaa">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">CVV</label>
                                    <input type="text" class="form-control" name="ccv" placeholder="CVV">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <h3><i class="fa fa-user"></i> Cliente</h3>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">CPF/CNPJ</label>
                                    <input type="text" class="form-control" name="cpfCnpj" placeholder="CPF/CNPJ">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">CEP</label>
                                    <input type="text" class="form-control" name="postalCode" placeholder="CEP">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nº</label>
                                    <input type="text" class="form-control" name="addressNumber" placeholder="Nº">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Telefone">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-success" id="btn-pay">Efetuar pagamento</button>
                            </div>
                        </div>

                    </form>

                    <div id="alert"></div>

                </div>

            </div>
        </div>

    </div>
</x-app-layout>

<script>
    $(document).ready(function(){
        $('#btn-pay').click(function(){

            $.post("{{url('/payment/credit-card/pay')}}", $('#form-pay').serialize(),
                function(data, status){
                    $("#alert").html('<div class="alert alert-secondary" role="alert">'+data+'</div>')
                })

        })
    })
</script>
