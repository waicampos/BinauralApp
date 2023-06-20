@extends('layouts.cadastro')

@section('content')

    <div>
        <h3>TERMO DE CONSENTIMENTO LIVRE E ESCLARECIDO – TCLE</h3>
    </div>

    <div class="container-fluid p-0 m-0">
        <p>Prezado/a Senhor/a, XXX</p>
        <p>Você está sendo convidado/a a participar de uma oficina sensorial Música e Emoções, que está sendo desenvolvida por 
            Cristiane Antunes Espindola, do Núcleo de Acessibilidade Educacional - NAE/IFSC (Campus Florianópolis).</p>
        <p>O objetivo do projeto de extensão é “Realizar encontros de terapia binaural para o alcance do bem estar físico e 
            emocional dos estudantes, bem como, aumentar a performance cognitiva para auxiliar no seu desenvolvimento pessoal e aprendizagem”. </p>
        <p>Em comprometimento com a resolução CNS 466/12 de 12/06/2012, sua participação se restringirá a autorizar o registro e a 
            utilização de informações coletadas nas oficinas sensoriais. </p>
        <p>Você terá a <strong>liberdade de se recusar a autorizar informações</strong> que lhe ocasionam constrangimento de alguma natureza e 
            também poderá <strong>desistir do projeto a qualquer momento</strong>, sem que a recusa ou a desistência lhe acarrete 
            qualquer prejuízo, bem como, caso seja do seu interesse e, mencionado ao coordenador, 
            <strong>terá livre acesso aos resultados do estudo</strong>.</p>
        <p><strong>Destacamos que a sua participação neste projeto é opcional e pode apresentar riscos ou desconfortos como: 
            cansaço ou aborrecimento ao tempo de exposição; desconforto, constrangimento ou alterações de comportamento durante a oficina. 
            Na ocorrência de qualquer dano será oferecido na forma de acompanhamento e assistência aos participantes, além de benefícios e 
            acompanhamentos posteriores ao encerramento e/ ou a interrupção do projeto. E serão ressarcidos no que se refere ao pagamento 
            de despesas do participante, comprovadamente decorrentes da pesquisa e indenização se refere à dano, também comprovadamente 
            decorrente do projeto, e nos termos da lei.</strong></p> 
        <p>Em caso de recusa ou de desistência em qualquer fase da pesquisa, <strong>você não será penalizado (a) de forma alguma</strong>.</p>
        <p>A sua participação constituirá de suma importância para o cumprimento do objetivo da pesquisa e os benefícios serão de 
            âmbito acadêmico e profissional para o campo da Psicologia Educacional do IFSC. </p>
        <p>Solicitamos a sua colaboração para:</p> 
            <ul>
                <li><strong>utilizar os dados das oficinas sensoriais</strong>, por um período de 3 meses</li> 
                <li>como também sua autorização para <strong>apresentar os resultados deste estudo</strong> em eventos da área de Educação e publicar 
            em revista científica nacional e/ou internacional.</li>
            </ul>
        <p>Você será esclarecido sobre a pesquisa em qualquer aspecto que desejar e trataremos da sua identidade com padrões 
            profissionais de sigilo, ou seja, não haverá identificação nominal. </p>
        <p>Após a utilização na pesquisa, os dados registrados, áudio e anotações ficarão sob a guarda e a responsabilidade do pesquisador, 
            por um período de cinco anos, sendo descartados após este prazo. </p>
        <p>Em caso de dúvida, você poderá procurar o pesquisador responsável por esta pesquisa, Cristiane Antunes Espindola, 
            pelo telefone: (48) 99991-5174 ou <a href="mailto:cristianeantunes@ifsc.edu.br" title="Enviar email para cristianeantunes@ifsc.edu.br">cristianeantunes@ifsc.edu.br</a>. </p>
        <p>Se você tiver alguma consideração ou dúvida sobre a ética que envolve a referida pesquisa, entre em contato com 
            Comitê de Ética em Pesquisa com Seres Humanos - CEPSH, telefone: (48) 3877-9078 ou no endereço: Rua 14 de Julho, 150, 
            1º andar, Sala 33 B, Bairro Coqueiros - Florianópolis/SC, CEP: 88075-010, E-mail: <a href="mailto:cepsh@ifsc.edu.br" title="Enviar email para cepsh@ifsc.edu.br">cepsh@ifsc.edu.br</a>.</p>
        <p>Após ser esclarecido sobre as oficinas e o uso dos dados para a pesquisa, no caso de você aceitar fazer parte do estudo, 
            assine ao final deste documento, que está em duas vias. Uma delas é sua e a outra é do pesquisador responsável. </p>
    </div>

    

    <div class="container-fluid my-5 p-0" id="consentimento">
        <h3>CONSENTIMENTO</h3>
        
        <p>Eu, <strong>{{ session('dto')->nome ?? "Nome não informado!" }}</strong>, RG nº 
        <strong>{{ session('dto')->documento ?? "Rg não informado!"}}</strong>, acredito ter sido suficientemente informado/a e 
        concordo em participar como voluntário/a da pesquisa descrita acima.</p>

        <p class="text-align-end">Florianópolis, {{ Carbon\Carbon::today()->format('d/m/Y')  }}</p>
        
        <form action="/cadastrar_participante" method="post">
            @csrf
            <div class="form-group my-2">

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="DTO[autorizacao]" id="autorizacao_1" value="1" required {{ session('dto')->autorizacao === 1 ? "checked" : "" }}>
                    <label for="autorizacao_1"><strong>Concordo</strong> com o Termo e AUTORIZO o uso de meus dados para os fins descritos acima. <span class="info-adicional">(Você receberá o Termo de Consentimento acima por email)</span> </label>   
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="DTO[autorizacao]" id="autorizacao_0" value="0" required {{ session('dto')->autorizacao === 0 ? "checked" : "" }}>
                    <label for="autorizacao_0"> <strong>NÃO concordo</strong> em autorizar o uso de meus dados para pesquisa, MAS desejo participar das Oficinas. <span class="info-adicional">(Seus dados não serão utilizados no projeto)</span></label>   
                </div>

                <div class="botoes_navegacao_cadastro">
                    <button class="btn btn-secondary" type="submit" name="voltar">Voltar</button>
                    <button class="btn btn-secondary" type="submit" name="avancar">Avançar</button>
                </div>

            </div>
         </form>
    </div>
    

        

@endsection




