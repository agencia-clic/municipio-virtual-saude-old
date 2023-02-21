
@csrf <!--token--> 

<!--- search -->
<div class="card mb-3 card-content">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Busca</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">

        <div class="row">	
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="topics_letter_fields" class="form-group">
                    <label for="topics_letter" id="label_topics_letter">FILTRO: Letra:</label>
                    <select id="topics_letter" name="topics_letter" class="form-control form-control-sm">
                        <option value="">...</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="I">I</option>
                        <option value="J">J</option>
                        <option value="K">K</option>
                        <option value="L">L</option>
                        <option value="M">M</option>
                        <option value="N">N</option>
                        <option value="O">O</option>
                        <option value="P">P</option>
                        <option value="Q">Q</option>
                        <option value="R">R</option>
                        <option value="S">S</option>
                        <option value="T">T</option>
                        <option value="U">U</option>
                        <option value="V">V</option>
                        <option value="W">W</option>
                        <option value="X">X</option>
                        <option value="Y">Y</option>
                        <option value="Z">Z</option>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="topics_fields" class="form-group">
                    <label for="topics" id="label_topics">FILTRO: TÓPICO:</label>
                    <input type="text" id="topics" name="topics" class="form-control form-control-sm" autocomplete="off">    
                </div>
            </div>
            
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div id="topics_sinais_fields" class="form-group">
                    <label for="topics_sinais" id="label_topics_sinais">FILTRO: SINAIS DE ALERTA:</label>
                    <input type="text" id="topics_sinais" name="topics_sinais" class="form-control form-control-sm" autocomplete="off">    
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <div id="topics_button_fields" class="form-group">
                    <label for="topics_button" id="label_topics_button"></label>
                    <button type="button" class="form-control btn btn-outline-secondary btn-sm query-topics" title="Buscar" url="{{ route('topics.form.query') }}">
                        <span class="fas fa-search" data-fa-transform="shrink-3 down-2"></span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<!--- result -->
<div class="card mb-3 card-content">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0">Resultado</h5>
            </div>
        </div>
    </div>
    
    <div class="card-body bg-light">
        <div class="accordion" id="res-topcs"></div>
    </div>
</div>

<script type="text/javascript">
   query_topics()
</script>