<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{url('/dashboard')}}">Cobranças</a> / Boleto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="bd-callout bd-callout-info">
                        <h3>{{Auth::user()->name}},</h3>
                    </div>

                    @if(!empty($barCode))
                        <div class="alert alert-success" role="alert">
                            <p> Abaixo o código de barras para realizar o pagamento.</p><br />
                            {{$barCode}}<br /><br />
                            <p>Obrigado.</p>
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            Não encontrado!
                        </div>
                    @endif

                </div>

            </div>
        </div>

    </div>
</x-app-layout>

<script>
    $(document).ready(function(){
        $('.btn-pay').click(function(){
            var id = $(this).data('id')


        })
    })
</script>
