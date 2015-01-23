<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <title>JIRS 2015 - Alteração de situação de trabalho</title>
  </head>
  <body>
    <?php $aceito = $aceito ? 'Aceito' : 'Rejeitado'; ?>
    <h2>Trabalho {{$aceito}}</h2>

    <div>
      <p>Caro {{$paper->author->nome}},</p>
      <p>Informamos que seu trabalho <strong>{{$paper->titulo}}</strong>, teve a situação alterada para <strong>{{$aceito}}</strong>.</p>
      <p>Att.,</p>
      <p>JIRS 2015</p>
    </div>
  </body>
</html>