<p>Olá {{$fullname}}</p>
<p>Você pediu para redefinir sua senha do site tal, clique no link abaixo</p>
<p><a href="{{ env('APP_URL') }}/redefinir/{{$token}}">Redefir sua senha</a></p>