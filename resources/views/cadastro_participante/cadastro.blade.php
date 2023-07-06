{{--
    
    Agrupamento de dados

    Confirma indicadores (se o cadastro for mais antigo) (NÃO FAZER AGORA) //
    Cidade, Número de Telefone, Dia e hora preferidos para a oficina //
    Nome e telefone do responsável se menor de idade // 
    Autorização (ver com a Cris como fica para menor de idade) //
    Playlist //

    --}}



<x-guest-layout>

    @unless ($errors->isEmpty())
        <p>Corrija os seguintes erros no seu formulário:</p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{$message}}</li>
            @endforeach
        </ul>
    @endunless

    <form id="form" method="POST" action="{{ route('cadastro') }}" class="needs-validation" novalidate>
        @csrf

        <!-- Circles which indicates the steps of the form: -->
        {{-- Os steps devem ser tantos quantos forem as tabs que serão mostradas --}}
        {{-- Exemplo: para uma pessoa que não vai ter a playlist, este passo não deve aparecer e nem a tab da playlist --}}
        {{-- Assim... tem que ver como vai ficar a lógica do javascript tbm! Acho q fica normal! --}}
        <div>

            @if ($user->needs_update)
            <span class="step"></span>
            @endif
            
            <span class="step"></span>

            <span class="step"></span>

            @if ($user->age < 18)
            <span class="step"></span>
            @endif

            <span class="step"></span>

            @if ($group->needs_playlist)
            <span class="step"></span>
            @endif


        <!-- <span class="step"></span> -->
        </div>

        <!-- One "tab" for each step in the form: -->

        {{-- 
            Indicadores do projeto:
                - busca no banco de dados os indicadores do grupo
                - compara com os indicadores do usuário autenticado
                - pega a data de update dos dados do usuário
                - vê se algum indicador necessita de atualização 
                - ver os indicadores do projeto que o usuário ainda não informou
            Responsável em caso de menor de idade:
                - pega no banco o responsável, caso tenha
                - se não, pede o responsável e o número de telefone
            TLCE:
                - Avisa da necessidade de ler o documento
                - Apresenta o documento
                - Pede o aceite
                - Avisa que o documento foi enviado por email e para trazer assinado no dia do início da oficina
            Playlist:
                - VISÍVEL APENAS PARA PESSOAS DO GRUPO QUE VAI TER PLAYLIST!
                - Perguntar se quer criar uma nova playlist ou usar alguma que já possua no spotify
                - Avisar que não vai poder ser alterado
                - Se pegar uma que já possua do spotify, indicar o uri da playlist
                - Neste caso, o ideal é pegar música por música e copiar para uma nova playlist na conta que irá utilizar no projeto? Será...
                - Se nova, página de busca de músicas e salvar nova playlist
        --}}


        <!-- Step #1: Atualizar Indicadores -->
        @if ($user->needs_update)
            <div class="tab">
                <fieldset class="">
                    <legend>Atualização dos Indicadores</legend>
                    <div>
                        <label for="" class="form-label"></label>
                        <input type="text" name="" id="" class="form-control" value="{{ old('') }}" placeholder="" pattern="" autocomplete="" required>
                        <x-input-error :messages="$errors->get('')" class="mt-2" />
                        <div class="error invalid-feedback"></div>
                    </div>    
            </fieldset>
            </div>
        @endif

          

        <!-- Step #2: cidade, telefone, hora preferida -->
        <div class="tab">           
            <fieldset class="">
                <legend></legend>
                <div>
                    <label for="city" class="form-label">Cidade:</label>
                    <input type="text" list="local-cities" name="city" id="city" class="form-control" value="{{ old('city') }}" placeholder="Cidade em que você mora" autocomplete="address-level2" required>
                    <datalist id="local-cities">
                        <option value="Florianópolis">
                        <option value="São José">
                        <option value="Palhoça">
                        <option value="Biguaçu">
                        <option value="Governador Celso Ramos">
                        <option value="Paulo Lopes">
                        <option value="Santo Amaro da Imperatriz">
                        <option value="São Pedro de Alcântara">
                        {{--  Talvez valha a pena puxar de uma api de cidades --}}
                    </datalist>
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    <div class="error invalid-feedback">Insira a cidade em que você mora</div>
                </div>    

                <div>
                    <label for="phone_number" class="form-label">Telefone com DDD:</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="DDD + Número" autocomplete="tel-national" required>
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    <div class="error invalid-feedback">Insira seu número de telefone</div>
                </div>   

                <div>
                    <label for="weekday_id" class="form-label">Qual seu dia da semana preferido para participar da oficina?</label>
                    <select name="weekday_id" id="weekday_id" required>
                        <option value="" selected disabled>Selecione um dia</option>
                        @foreach($weekdays as $day) 
                        <option value="{{$day->id}}">{{ucfirst($day->portuguese)}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('weekday_id')" class="mt-2" />
                    <div class="error invalid-feedback">Escolha um dia da semana</div>
                </div>   

                <div>
                    <label for="preferred_hour" class="form-label">Seu horário preferido para participar da oficina:</label>

                    <select name="hour" id="hour" required>
                        <option value="" selected disabled></option>
                        @foreach(range(8, 17, 1) as $hour) 
                            <option value="{{$hour}}">{{$hour}}</option>
                        @endforeach
                    </select>
                    <span class="">:</span>

                    <select name="minute" id="minute" required>
                        <option value="" selected disabled></option>
                        <option value="00">00</option>
                        <option value="30">30</option>
                    </select>
                    <!-- <span class="">m</span> -->

                    <!-- <input type="" min="08:00" max="17:00" step="1800" name="preferred_hour" id="preferred_hour" class="form-control" value="{{ old('preferred_hour') }}" required>
                    <x-input-error :messages="$errors->get('preferred_hour')" class="mt-2" />
                    <div class="error invalid-feedback">Insira a sua hora preferida</div>

                    <label for="preferred_hour" class="form-label">Hora preferida para participar da oficina:</label>
                    <input type="time" min="08:00" max="17:00" step="1800" name="preferred_hour" id="preferred_hour" class="form-control" value="{{ old('preferred_hour') }}" required>
                    <x-input-error :messages="$errors->get('preferred_hour')" class="mt-2" />
                    <div class="error invalid-feedback">Insira a sua hora preferida</div> -->
                </div>   

            </fieldset>
        </div>

        <!-- Step #3: Contato para emergência -->
        <div class="tab">
            <fieldset class="">
                <legend>Contato para emergência</legend>
                <!--  -->
                <div>
                    <label for="reference_name" class="form-label">Nome de uma pessoa para contato:</label>
                    <input type="text" name="reference_name" id="reference_name" class="form-control" value="{{ old('reference_name') }}" placeholder="Nome da pessoa para contato" required>
                    <x-input-error :messages="$errors->get('reference_name')" class="mt-2" />
                    <div class="error invalid-feedback">Insira um nome válido</div>
                </div>
                <div>
                    <label for="reference_phone" class="form-label">Telefone com DDD:</label>
                    <input type="text" name="reference_phone" id="reference_phone" class="form-control" value="{{ old('reference_phone') }}" placeholder="DDD + Número" autocomplete="tel-national" required>
                    <x-input-error :messages="$errors->get('reference_phone')" class="mt-2" />
                    <div class="error invalid-feedback">Insira um número de telefone: DDD + Número</div>
                </div>     
            </fieldset>
        </div>


        <!-- Step #4: Nome e telefone do responsável se menor de idade  -->
       @if ($user->age < 18)
        <div class="tab">
            <fieldset class="">
                <legend>Dados do/a responsável legal</legend>
                <!--  -->
                <div>
                    <label for="responsavel_nome" class="form-label">Nome do/a responsável:</label>
                    <input type="text" name="responsavel_nome" id="responsavel_nome" class="form-control" value="{{ old('responsavel_nome') }}" placeholder="Nome da pessoa responsável por você" required>
                    <x-input-error :messages="$errors->get('responsavel_nome')" class="mt-2" />
                    <div class="error invalid-feedback">Insira um nome válido</div>
                </div>
                <div>
                    <label for="responsavel_phone" class="form-label">Telefone com DDD:</label>
                    <input type="text" name="responsavel_phone" id="responsavel_phone" class="form-control" value="{{ old('responsavel_phone') }}" placeholder="DDD + Número" autocomplete="tel-national" required>
                    <x-input-error :messages="$errors->get('responsavel_phone')" class="mt-2" />
                    <div class="error invalid-feedback">Insira um número de telefone: DDD + Número</div>
                </div>     
            </fieldset>
        </div>
        @endif
         


        <!-- Step #5: TLCE -->
        <div class="tab">
            
            <fieldset class="">
                <legend>TERMO DE CONSENTIMENTO LIVRE E ESCLARECIDO – TCLE</legend>

                <div class="container-fluid p-0 m-0">
                    <p>Prezado/a Senhor/a, <strong>{{$user->name}} {{$user->lastname}}</strong></p>
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
                    
                    <p>Eu, <strong>{{$user->name}} {{$user->lastname}}</strong>, CPF nº 
                    <strong>{{ $user->cpf }}</strong>, acredito ter sido suficientemente informado/a e 
                    concordo em participar como voluntário/a da pesquisa descrita acima.</p>

                    <p class="text-align-end">Florianópolis, {{ Carbon\Carbon::today()->format('d/m/Y')  }}</p>
                    
                    
                        <div class="form-group my-2">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" onclick="authInfo(true)" name="authorization" id="authorization_true" value="1" required {{ old('authorization') === 1 ? "checked" : "" }}>
                                <label for="autorizacao_1"><strong>Concordo</strong> com o Termo e AUTORIZO o uso de meus dados para os fins descritos acima. </label>
                                <div id="auth-true-info" class="d-none">Você receberá o Termo de Consentimento acima por email. Não esqueça de trazer assinado no dia da primeira oficina!</div> 
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" onclick="authInfo(false)" name="authorization" id="authorization_false" value="0" required {{ old('authorization') === 1 ? "checked" : "" }}>
                                <label for="autorizacao_0"> <strong>NÃO concordo</strong> em autorizar o uso de meus dados para pesquisa, MAS desejo participar das Oficinas.</label>   
                                <div id="auth-false-info" class="d-none">Seus dados não serão utilizados</div> 
                            </div>

                        </div>
                    
                </div> 

            </fieldset>

        </div>




        @if ($group->needs_playlist)
        <!-- Step #6: Playlist -->
        <div class="tab">
            
            <fieldset class="">
                <legend>Fake playlist (temporário)</legend>
                <div>
                    <label for="playlist_uri" class="form-label"></label>
                    <input type="text" name="playlist_uri" id="playlist_uri" class="form-control" value="{{ old('playlist_uri') }}" placeholder="Insira a URI da playlist" required>
                    <x-input-error :messages="$errors->get('playlist_uri')" class="mt-2" />
                    <div class="error invalid-feedback">Insira a sua playlist</div>
                </div>    

            </fieldset>

        </div>
        @endif

       


        <div >
            <div >
                <button type="button" id="prevBtn" class="btn btn-primary" onclick="nextPrev(-1)">Anterior</button>
                <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)" disabled>Próximo</button>
            </div>
        </div>


    </form>


    <script>


        /** Mostrando info do termo de autorização */
        function authInfo($auth) {
            let infoAuthTrue = document.querySelector('#auth-true-info');
            let infoAuthFalse = document.querySelector('#auth-false-info');
            if ($auth) {
                if (!infoAuthFalse.classList.contains('d-none')) {
                    infoAuthFalse.classList.add('d-none');
                }
                infoAuthTrue.classList.remove('d-none');
            } else {
                if (!infoAuthTrue.classList.contains('d-none')) {
                    infoAuthTrue.classList.add('d-none');
                }
                infoAuthFalse.classList.remove('d-none');
            }
        }

        // Preciso pegar o valor de cada current tab validation e mudar ela....

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                let valid = true;
                currentInputs = form.querySelectorAll("input");
                currentSelects = form.querySelectorAll("select");
                //foreach input, checkvalidity() against constraints e aí se algum for invalido, seta como invalido
                currentInputs.forEach((input) => {

                    if (! is_valid(input)) {
                        console.log(input.name);
                        input.classList.add('is-invalid');
                        valid = false;
                        
                    }

                })
                currentSelects.forEach((select) => {
                    if (!is_valid(select)) {
                        select.classList.add('is-invalid');
                        valid = false;
                    }
                })
                // If the valid status is true, mark the step as finished and valid:

                if (!valid) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
        })()



        // Usando o exemplo padrão do W3Schools: https://www.w3schools.com/howto/howto_js_form_steps.asp 
        let currentTab = 0; // Current tab is set to be the first tab (0)
        const tabs = document.getElementsByClassName("tab");
        showTab(currentTab); // Display the current tab

        

        function showTab(index) {
        // This function will display the specified tab of the form ...

        tabs[index].style.display = "block";
        // ... and fix the Previous/Next buttons:
        let nextBtn = document.getElementById("nextBtn");
        let prevBtn = document.getElementById("prevBtn");

        if (index == 0) {
            prevBtn.style.display = "none";
        } else {
            prevBtn.style.display = "inline";
        }
        if (index == (tabs.length - 1)) {
            // Aqui poderia mudar o tipo de botão se fosse o caso... Fazer ele nativamente ser um submit e tirar o onclick()
            // Na verdade, vou deixar o botão de enviar aqui, mas escondido, aí só mostra ou esconde ele
            nextBtn.innerText = "Registrar!";
            if (!validateStepAndEnableNext()) {
                nextBtn.disabled = true;
            }
        } else {
            // Aqui tem que fazer voltar ao normal se voltar da tela final, para exibir apenas Próximo e não ser um submit
            nextBtn.innerText = "Próximo";
            nextBtn.type = 'button';
            nextBtn.setAttribute('onclick', 'nextPrev(1)');
            if (!validateStepAndEnableNext()) {
                nextBtn.disabled = true;
            }
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(index)
        }

        function nextPrev(increment) {
        // se n == -1 volta
        // se n == 1 avança
        // This function will figure out which tab to display
        if ((currentTab + increment) >= tabs.length) {
            //...the form gets submitted:
            if(validateForm()) {
                document.getElementById("form").submit();
            }
            //console.log(forms);
            //forms.forEach(form => form.submit());
            return;
        }

        // Exit the function if any field in the current tab is invalid:
        if (increment == 1 && !validateForm()) return false;
        // Hide the current tab:
        tabs[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + increment;
        // if you have reached the end of the form... :
        // Otherwise, display the correct tab:
        showTab(currentTab);
        }


        

        
        // Checar se todos os campos estão ok
        // Essa checagem precisa ser feita a cada input!
        // Ou seja
        // Cada input chama o validate!
        // e, ao final do validate, chama o habilita submit e próximo...
        



        function validate(input) {
            // checkvalidity
            // muda o css para ficar inválido
            //console.log("Validando AGORA: " + input.name);
            if (!is_valid(input)){
                if (input.classList.contains('is-valid')) {
                    input.classList.remove('is-valid');
                }
                if (!input.classList.contains('is-invalid')) {
                    input.classList.add('is-invalid');
                }
            } else {
                if (input.classList.contains('is-invalid')) {
                    input.classList.remove('is-invalid');
                }
            }
            if (input.value === "") {
                if (input.classList.contains('is-invalid')) {
                    input.classList.remove('is-invalid');
                }
                console.log("É vazio");
            }
            if(input.name === 'password') {
                console.log("O input é password");
                let confirmation = form.querySelector('[name="password_confirmation"]');
                console.log(confirmation);
                if (confirmation.value != '' && !is_valid(confirmation)) {
                    if (! confirmation.classList.contains('is-invalid')) {
                        confirmation.classList.add('is-invalid');
                    }
                } else if (is_valid(confirmation)) {
                    confirmation.classList.remove('is-invalid');
                    // if (! confirmation.classList.contains('is-valid')) {
                    //     confirmation.classList.add('is-valid');
                    // }
                }
            }
            validateStepAndEnableNext();
        }




        function validateStepAndEnableNext() {
            let valid = true;
            currentInputs = tabs[currentTab].querySelectorAll("input");
            currentSelects = tabs[currentTab].querySelectorAll("select");
            //foreach input, checkvalidity() against constraints e aí se algum for invalido, seta como invalido
            currentInputs.forEach((input) => {
                if (! is_valid(input)) {
                    valid = false;
                }
            })
            currentSelects.forEach((select) => {
                if (!is_valid(select)) {
                    valid = false;
                }
            })
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                let step = document.getElementsByClassName("step")[currentTab];
                step.classList.add('finish');
                nextBtn.disabled = false;
            }
            else {
                let step = document.getElementsByClassName("step")[currentTab];
                step.classList.remove('finish');
                nextBtn.disabled = true;
            }
            return valid; // return the valid status
        }




        // Validate CPF
        // Retirada de: {site que não lembro}
        // Para entender a regra, ver Macoratti
        function validateCPF(cpf) {	

            cpf = cpf.replace(/[^\d]+/g,'');	
            if(cpf == '') return false;	

            // Elimina CPFs invalidos conhecidos	
            if (cpf.length != 11 || 
                cpf == "00000000000" || 
                cpf == "11111111111" || 
                cpf == "22222222222" || 
                cpf == "33333333333" || 
                cpf == "44444444444" || 
                cpf == "55555555555" || 
                cpf == "66666666666" || 
                cpf == "77777777777" || 
                cpf == "88888888888" || 
                cpf == "99999999999")
                    return false;		

            // Valida 1o digito	
            // Itera pelos primeiros nove dígitos realizando as multiplicações por valor incremental a partir de 2 e a soma do resultado
            // Divide a soma por 11, aplicando a regra sobre o resto

            add = 0;	
            for (i=0; i < 9; i ++)		
                add += parseInt(cpf.charAt(i)) * (10 - i);	
                rev = 11 - (add % 11);	
                if (rev == 10 || rev == 11)		
                    rev = 0;	
                if (rev != parseInt(cpf.charAt(9)))		
                    return false;

            // Valida 2o digito	
            // Itera pelos primeiros dez dígitos realizando as multiplicações por valor incremental a partir de 2 e a soma do resultado
            // Divide a soma por 11, aplicando a regra sobre o resto

            add = 0;	
            for (i = 0; i < 10; i ++)		
                add += parseInt(cpf.charAt(i)) * (11 - i);	
            rev = 11 - (add % 11);	
            if (rev == 10 || rev == 11)	
                rev = 0;	
            if (rev != parseInt(cpf.charAt(10)))
                return false;		
            return true;   
        }


        // Validate confirm Password
        function validatePasswordConfirmation(password, passwordToMatch) {
            return password === passwordToMatch;
        }



        // Validate Password
        function validatePassword(passwd) {
        // Deveria ser APENAS um regex, mas não fui capaz de entender como faz

            let valid = true;

            let hasDigit = new RegExp(/\d+/);
            let hasUpper = new RegExp(/\p{Lu}/u);
            let minLength = new RegExp(/(\S){6,}/);
            let noSpaces = new RegExp(/^\S*$/);
            let hasSpecialChar = new RegExp(/[#$%&*@!]+/);

            let criterio = document.querySelector('#password ~ .invalid-feedback #hasDigit');

            if (!hasDigit.test(passwd)) {
                if (criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.remove('criterio-atendido');
                }
                valid = false;
            } else {
                if (!criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.add('criterio-atendido');
                }
            }

            criterio = document.querySelector('#password ~ .invalid-feedback #hasUpperCase');
            if (!hasUpper.test(passwd)) {
                if (criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.remove('criterio-atendido');
                }
                valid = false;
            } else {
                if (!criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.add('criterio-atendido');
                }
            }

            criterio = document.querySelector('#password ~ .invalid-feedback #mixLength');
            if (!minLength.test(passwd)) {
                if (criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.remove('criterio-atendido');
                }
                valid = false;
            } else {
                if (!criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.add('criterio-atendido');
                }
            }


            //criterio = document.querySelector('#password ~ .invalid-feedback #hasDigit');
            if (!noSpaces.test(passwd)) {
                // if (criterio.classList.contains('criterio-atendido')) {
                //     criterio.classList.remove('criterio-atendido');
                // }
                valid = false;
            } 
            // else {
            //     if (!criterio.classList.contains('criterio-atendido')) {
            //         criterio.classList.add('criterio-atendido');
            //     }
            // }


            criterio = document.querySelector('#password ~ .invalid-feedback #hasSpecialChar');
            if (!hasSpecialChar.test(passwd)) {
                if (criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.remove('criterio-atendido');
                }
                valid = false;
            } else {
                if (!criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.add('criterio-atendido');
                }
            }

            return valid;

        }

        function is_valid(input) {
            if (input.value === '' && input.required === "true") {
                return false;
            }
            if (input.name === 'cpf') {
                return validateCPF(input.value);
            } 
            if (input.name === 'password') {
                return validatePassword(input.value);
            }
            if (input.name === 'password_confirmation') {
                let passwordToMatch = form.querySelector('[name="password"]');
                return validatePasswordConfirmation(input.value, passwordToMatch.value);
            }
            return input.checkValidity();
        }
 


        // Adicionar Event Listeners para todos os campos
        // Fetch all the forms
        const forms = document.querySelectorAll('.needs-validation')
        // Get all the inputs and selects on each form
        forms.forEach((form) => {
            let inputs = form.querySelectorAll('input');
            inputs.forEach(input => input.addEventListener('input', () => {
                validate(input);
            }));
            let selects = form.querySelectorAll('select');
            selects.forEach(select => select.addEventListener('change', () => {
                validate(select);
            }));
        })



        // // Adiciona os event listeners
        // (() => {
        // 'use strict'

        // // Fetch all the forms
        // const forms = document.querySelectorAll('.needs-validation')
        // // Get all the inputs and selects on each form
        // forms.forEach((form) => {
        //     let inputs = form.querySelectorAll('input');
        //     inputs.forEach(input => input.addEventListener('oninput', () => {
        //         console.log(input.value);
        //         //validateInput(input);
                
        //     }));
        //     let selects = form.querySelectorAll('select');
        //     selects.forEach(select => select.addEventListener('oninput', () => {
        //         validateInput(select);
        //     }));
        // })

        // // Loop over them and prevent submission
        
        // })()


        function validateForm() {
        // This function deals with validation of the form fields
        // Essa validação aqui que pode melhorar um pouquinho, juntando a validação default sugerida pelo Bootstrap
        let valid = true;
        currentInputs = tabs[currentTab].querySelectorAll("input");
        currentSelects = tabs[currentTab].querySelectorAll("select");
        //foreach input, checkvalidity() against constraints e aí se algum for invalido, seta como invalido
        currentInputs.forEach((input) => {
            if (! is_valid(input)) {
                input.classList.add('is-invalid');
                valid = false;
            }
        })
        currentSelects.forEach((select) => {
            if (!is_valid(select)) {
                select.classList.add('is-invalid');
                valid = false;
            }
        })
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            let step = document.getElementsByClassName("step")[currentTab];
            console.log("Bolinha do Step:");
            console.log(step);
            step.className += " finish";
        }
        return valid; // return the valid status
        }


        function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
        }


        // Toggle Password Visibility

        const seePassword = document.querySelector('#see_password');
        const seePasswordConfirm = document.querySelector('#see_password_confirm');

        seePassword.addEventListener('click', () => {
            toggleVisibility('#password');
            toggleIcon(seePassword);
        });

        seePasswordConfirm.addEventListener('click', () => {
            toggleVisibility('#password_confirmation');
            toggleIcon(seePasswordConfirm);
        });

        function toggleIcon(icon) {
            if (icon.classList.contains('bi-eye')) {
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
            else {
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        function toggleVisibility(inputId) {
            let input = document.querySelector(inputId);
            if (input.getAttribute('type') === 'password') {
                input.setAttribute('type', 'text');
                return;
            }
            input.setAttribute('type', 'password');
        }

        // Mostrar o campo de nome social
        const nomeSocialCheck = document.querySelector('#has_social_name');
        const nomeSocial = document.querySelector('#nome_social');
        const inputsNomeSocial = document.querySelectorAll('#nome_social input');
        nomeSocialCheck.addEventListener('change', () => {
            nomeSocial.classList.toggle('d-none');
            if (nomeSocial.classList.contains('d-none')) {
                inputsNomeSocial.forEach((input) => {
                    input.required = false;
                    input.value = '';
                }
            )
            } else {
                inputsNomeSocial.forEach((input) => {
                    input.required = true;
                    if (input.value === '') {
                        nextBtn.disabled = true};
                    }
                )
            }
        });

        // Validar se senhas estão batendo!

        // Validar conforme digita
        // Precisa pegar todos os input texts
        // e colocar um listener ao value change
        // e aí aplicar a validação de cada campo
        
        // const input_texts = document.querySelectorAll("input[type='text']");

        // input_texts.forEach((input) => {
        //     input.addEventListener('change', () => {validate_input(input)});
        // });

        // function validate_input(input) {
        //     let error_element = document.querySelector('#'+input.id + '+ .error');
        //     console.log(error_element);
        //     console.log("validando"+input.id);
        //     console.log(input.checkValidity());
        //     if(!input.checkValidity()) {
        //         error_element.classList.remove('invalid-feedback');
        //         input.setCustomValidity('Valor inválido');
        //     }
        //     else {
        //         error_element.classList.add('invalid-feedback');
        //         console.log("valid " + error_element);
        //     }
        // }

        // script Valida CPF:
        // https://www.geradorcpf.com/javascript-validar-cpf.htm

        // Para saber mais como funciona a regra de validação do CPF: 
        // https://www.macoratti.net/alg_cpf.htm 




    </script>

</x-guest-layout>
