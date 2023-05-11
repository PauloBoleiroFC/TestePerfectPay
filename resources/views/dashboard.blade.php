<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <button type="button" class="btn btn-primary" id="new-charge">Nova Cobrança</button>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vencimento</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th class="pull-right">Pagar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($charges as $charge)
                            <tr>
                                <td>{{$charge->id ?? ''}}</td>
                                <td>{{date_format(date_create($charge->dueDate), "d/m/Y")}}</td>
                                <td>{{number_format($charge->value, 2, ',', ' ')}}</td>
                                <td>{{status($charge->status)}}</td>
                                <td class="pull-right">
                                    <a href="{{url('payment/get-bar-code')}}/{{Crypt::encryptString($charge->id)}}" title="Boleto" class="btn btn-primary btn-sm btn-pay"><i class="fa fa-barcode"></i></a>
                                    <a href="{{url('payment/pix')}}/{{Crypt::encryptString($charge->id)}}" title="Pix" class="btn btn-primary btn-sm btn-pay">Pix</a>
                                    <a href="{{url('payment/credit-card')}}/{{Crypt::encryptString($charge->id)}}" title="Cartão" class="btn btn-primary btn-sm btn-pay"><i class="fa fa-credit-card"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>
</x-app-layout>

<script>
    $(document).ready(function(){
        $('#new-charge').click(function(){
            $.get("{{url('/charge/new')}}", {},
                function(data, status){
                location.reload();
            })
        })
    })
</script>
