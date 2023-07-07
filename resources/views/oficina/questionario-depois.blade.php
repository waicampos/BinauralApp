<x-app-layout>

    <form action="{{ route('questionario_fim') }}" method="post">
        @csrf
        <fieldset class="my-3">
            <legend>Como você se sente depois da experiência?</legend>

            <div>
                <input type="hidden" name="question" value="Como você se sente depois da experiência?">
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="1" value="1-Relaxado" required>
                <label for="1" class="form-check-label">Relaxado</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="2" value="2-Alegre">
                <label for="2" class="form-check-label">Alegre</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="3" value="3-Concentrado" >
                <label for="3" class="form-check-label">Concentrado</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="4" value="4-Atento" >
                <label for="4" class="form-check-label">Atento</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="5" value="5-Eufórico" >
                <label for="5" class="form-check-label">Eufórico</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="6" value="6-Sem alteração da sensação inicial" >
                <label for="6" class="form-check-label">Sem alteração da sensação inicial</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="7" value="7-Outro" >
                <label for="7" class="form-check-label">Outro: </label>
                <input type="text" class="" name="sentimento" id="7" placeholder="" disabled>
            </div>

        </fieldset>

        <button type="submit" class="btn btn-primary">Encerrar Oficina</button>

    </form>

</x-app-layout>