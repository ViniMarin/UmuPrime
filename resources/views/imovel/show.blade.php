@extends('layouts.app')

@section('title', $imovel->titulo . ' - UmuPrime Imóveis')

@section('content')

<!-- Property Details -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- COLUNA ESQUERDA (galeria + detalhes) -->
            <div class="col-lg-8 order-1 order-lg-1">
                <div class="property-images mb-4">
                    @php $qtdImgs = $imovel->imagens->count(); @endphp

                    @if($qtdImgs > 0)
                        <div class="main-image mb-3 position-relative">
                            <img
                                src="{{ asset('storage/' . $imovel->imagens->first()->caminho_imagem) }}"
                                alt="{{ $imovel->titulo }}"
                                class="img-fluid rounded shadow main-display-img"
                                data-index="0"
                                style="width: 100%; height: 400px; object-fit: cover; cursor: zoom-in;"
                            >
                            @if($qtdImgs > 1)
                                <button class="gallery-prev" type="button" aria-label="Imagem anterior">&#10094;</button>
                                <button class="gallery-next" type="button" aria-label="Próxima imagem">&#10095;</button>
                            @endif
                        </div>

                        @if($qtdImgs > 1)
                        <div class="row g-3 gallery-thumbs">
                            @foreach($imovel->imagens as $i => $imagem)
                                <div class="col-md-3 col-6">
                                    <img
                                        src="{{ asset('storage/' . $imagem->caminho_imagem) }}"
                                        alt="{{ $imovel->titulo }}"
                                        class="img-fluid rounded shadow-sm thumbnail-image {{ $loop->first ? 'active-thumbnail' : '' }}"
                                        data-index="{{ $i }}"
                                        style="width:100%; height:120px; object-fit:cover; cursor:pointer;"
                                        loading="lazy"
                                    >
                                </div>
                            @endforeach
                        </div>
                        @endif
                    @else
                        <div class="no-image text-center py-5 bg-light rounded">
                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Nenhuma imagem disponível</p>
                        </div>
                    @endif
                </div>

                <!-- 🔽 CAIXA DE INFORMAÇÕES (MOBILE) — logo abaixo das imagens -->
                <div class="d-block d-lg-none mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="price-section text-center mb-4">
                                <div class="property-type badge bg-primary mb-2">
                                    {{ ucfirst($imovel->tipo_negocio) }}
                                </div>
                                <h3 class="price fw-bold mb-0 property-price">
                                    {{ $imovel->valor_formatado }}
                                </h3>
                                @if($imovel->tipo_negocio == 'aluguel')
                                <small class="text-muted">/ mês</small>
                                @endif
                            </div>

                            <div class="property-details mb-4">
                                <h5 class="fw-bold mb-3">{{ $imovel->titulo }}</h5>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    {{ $imovel->endereco }}
                                    @if($imovel->numero), {{ $imovel->numero }}@endif
                                    <br>
                                    {{ $imovel->bairro }} - {{ $imovel->cidade }}/{{ $imovel->estado }}
                                </p>

                                <div class="row text-center">
                                    @if($imovel->quartos)
                                    <div class="col-4">
                                        <i class="fas fa-bed fa-2x mb-2" style="color: var(--primary-color);"></i>
                                        <div class="fw-bold">{{ $imovel->quartos }}</div>
                                        <small class="text-muted">Quartos</small>
                                    </div>
                                    @endif
                                    @if($imovel->banheiros)
                                    <div class="col-4">
                                        <i class="fas fa-bath fa-2x mb-2" style="color: var(--primary-color);"></i>
                                        <div class="fw-bold">{{ $imovel->banheiros }}</div>
                                        <small class="text-muted">Banheiros</small>
                                    </div>
                                    @endif
                                    @if($imovel->area_construida)
                                    <div class="col-4">
                                        <i class="fas fa-ruler-combined fa-2x mb-2" style="color: var(--primary-color);"></i>
                                        <div class="fw-bold">{{ $imovel->area_construida }}</div>
                                        <small class="text-muted">m²</small>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="additional-info mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Referência:</strong><br>
                                        <span class="text-muted">{{ $imovel->referencia }}</span>
                                    </div>
                                    <div class="col-6">
                                        <strong>Tipo:</strong><br>
                                        <span class="text-muted">{{ ucfirst($imovel->tipo_imovel) }}</span>
                                    </div>
                                </div>
                                @if($imovel->area_total)
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <strong>Área Total:</strong><br>
                                        <span class="text-muted">{{ $imovel->area_total }}m²</span>
                                    </div>
                                    @if($imovel->vagas_garagem)
                                    <div class="col-6">
                                        <strong>Garagem:</strong><br>
                                        <span class="text-muted">{{ $imovel->vagas_garagem }} vaga(s)</span>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>

                            <div class="contact-buttons">
                                <a href="https://wa.me/5544997292225?text=Olá! Tenho interesse no imóvel {{ $imovel->referencia }} - {{ $imovel->titulo }}" 
                                   class="btn btn-success w-100 mb-3" target="_blank">
                                    <i class="fab fa-whatsapp"></i> Conversar no WhatsApp
                                </a>
                                <a href="{{ route('contato') }}" class="btn btn-primary w-100">
                                    <i class="fas fa-envelope"></i> Enviar Mensagem
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 🔼 /MOBILE CARD -->

                <!-- Descrição -->
                <div class="card-custom mb-4">
                    <h2 class="section-title">Descrição do Imóvel</h2>
                    <hr>
                    <p class="text-muted">{{ $imovel->descricao ?? 'Descrição não disponível.' }}</p>
                </div>

                <!-- Informações Gerais -->
                <div class="card-custom mb-4">
                    <h2 class="section-title">Informações Gerais</h2>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-4 info-item"><strong>Referência:</strong> {{ $imovel->referencia }}</div>
                        <div class="col-md-4 info-item"><strong>Tipo:</strong> {{ ucfirst($imovel->tipo_imovel) }}</div>
                        <div class="col-md-4 info-item"><strong>Status:</strong> {{ ucfirst($imovel->status) }}</div>
                        <div class="col-md-4 info-item"><strong>Negócio:</strong> {{ ucfirst($imovel->tipo_negocio) }}</div>
                    </div>
                </div>

                <!-- Detalhes do Imóvel -->
                <div class="card-custom mb-4">
                    <h2 class="section-title">Detalhes do Imóvel</h2>
                    <hr>
                    <div class="row g-3">
                        @if($imovel->quartos)
                        <div class="col-md-3 feature-item"><i class="fas fa-bed"></i> {{ $imovel->quartos }} Quartos</div>
                        @endif
                        @if($imovel->suites)
                        <div class="col-md-3 feature-item"><i class="fas fa-door-closed"></i> {{ $imovel->suites }} Suítes</div>
                        @endif
                        @if($imovel->banheiros)
                        <div class="col-md-3 feature-item"><i class="fas fa-bath"></i> {{ $imovel->banheiros }} Banheiros</div>
                        @endif
                        @if($imovel->vagas_garagem)
                        <div class="col-md-3 feature-item"><i class="fas fa-car"></i> {{ $imovel->vagas_garagem }} Vagas</div>
                        @endif
                        @if($imovel->andar)
                        <div class="col-md-3 feature-item"><i class="fas fa-building"></i> {{ $imovel->andar }}º Andar</div>
                        @endif
                        @if($imovel->area_total)
                        <div class="col-md-3 feature-item"><i class="fas fa-vector-square"></i> {{ $imovel->area_total }} m² Área Total</div>
                        @endif
                        @if($imovel->area_construida)
                        <div class="col-md-3 feature-item"><i class="fas fa-ruler-combined"></i> {{ $imovel->area_construida }} m² Construída</div>
                        @endif
                    </div>
                </div>

                <!-- Valores -->
                <div class="card-custom mb-4">
                    <h2 class="section-title">Valores</h2>
                    <hr>
                    <div class="row g-3">
                        <div class="col-md-4 info-item"><strong>Valor do Imóvel:</strong><br>{{ $imovel->valor_formatado }}</div>
                        @if($imovel->valor_condominio)
                        <div class="col-md-4 info-item"><strong>Condomínio:</strong><br>R$ {{ number_format($imovel->valor_condominio, 2, ',', '.') }}</div>
                        @endif
                        @if($imovel->valor_iptu)
                        <div class="col-md-4 info-item"><strong>IPTU:</strong><br>R$ {{ number_format($imovel->valor_iptu, 2, ',', '.') }}</div>
                        @endif
                    </div>
                </div>

                <!-- Localização -->
                <div class="card-custom mb-4">
                    <h2 class="section-title">Localização</h2>
                    <hr>
                    <p>
                        {{ $imovel->endereco }}
                        @if($imovel->numero), {{ $imovel->numero }}@endif
                        @if($imovel->complemento) - {{ $imovel->complemento }} @endif
                        <br>
                        {{ $imovel->bairro }} - {{ $imovel->cidade }}/{{ $imovel->estado }}
                        @if($imovel->cep) - CEP: {{ $imovel->cep }} @endif
                    </p>

                    @if($imovel->latitude && $imovel->longitude)
                        <div id="map" style="width: 100%; height: 350px;" class="rounded shadow"></div>
                    @endif
                </div>
            </div><!-- /col-lg-8 -->

            <!-- COLUNA DIREITA (sidebar desktop) -->
            <div class="col-lg-4 order-2 order-lg-2">
                <div class="d-none d-lg-block">
                    <div class="property-info-card">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="price-section text-center mb-4">
                                    <div class="property-type badge bg-primary mb-2">
                                        {{ ucfirst($imovel->tipo_negocio) }}
                                    </div>
                                    <h3 class="price fw-bold mb-0 property-price">
                                        {{ $imovel->valor_formatado }}
                                    </h3>
                                    @if($imovel->tipo_negocio == 'aluguel')
                                    <small class="text-muted">/ mês</small>
                                    @endif
                                </div>

                                <div class="property-details mb-4">
                                    <h5 class="fw-bold mb-3">{{ $imovel->titulo }}</h5>
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        {{ $imovel->endereco }}
                                        @if($imovel->numero), {{ $imovel->numero }}@endif
                                        <br>
                                        {{ $imovel->bairro }} - {{ $imovel->cidade }}/{{ $imovel->estado }}
                                    </p>

                                    <div class="row text-center">
                                        @if($imovel->quartos)
                                        <div class="col-4">
                                            <i class="fas fa-bed fa-2x mb-2" style="color: var(--primary-color);"></i>
                                            <div class="fw-bold">{{ $imovel->quartos }}</div>
                                            <small class="text-muted">Quartos</small>
                                        </div>
                                        @endif
                                        @if($imovel->banheiros)
                                        <div class="col-4">
                                            <i class="fas fa-bath fa-2x mb-2" style="color: var(--primary-color);"></i>
                                            <div class="fw-bold">{{ $imovel->banheiros }}</div>
                                            <small class="text-muted">Banheiros</small>
                                        </div>
                                        @endif
                                        @if($imovel->area_construida)
                                        <div class="col-4">
                                            <i class="fas fa-ruler-combined fa-2x mb-2" style="color: var(--primary-color);"></i>
                                            <div class="fw-bold">{{ $imovel->area_construida }}</div>
                                            <small class="text-muted">m²</small>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="additional-info mb-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <strong>Referência:</strong><br>
                                            <span class="text-muted">{{ $imovel->referencia }}</span>
                                        </div>
                                        <div class="col-6">
                                            <strong>Tipo:</strong><br>
                                            <span class="text-muted">{{ ucfirst($imovel->tipo_imovel) }}</span>
                                        </div>
                                    </div>
                                    @if($imovel->area_total)
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <strong>Área Total:</strong><br>
                                            <span class="text-muted">{{ $imovel->area_total }}m²</span>
                                        </div>
                                        @if($imovel->vagas_garagem)
                                        <div class="col-6">
                                            <strong>Garagem:</strong><br>
                                            <span class="text-muted">{{ $imovel->vagas_garagem }} vaga(s)</span>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>

                                <div class="contact-buttons">
                                    <a href="https://wa.me/5544997292225?text=Olá! Tenho interesse no imóvel {{ $imovel->referencia }} - {{ $imovel->titulo }}" 
                                       class="btn btn-success w-100 mb-3" target="_blank">
                                        <i class="fab fa-whatsapp"></i> Conversar no WhatsApp
                                    </a>
                                    <a href="{{ route('contato') }}" class="btn btn-primary w-100">
                                        <i class="fas fa-envelope"></i> Enviar Mensagem
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /d-none d-lg-block -->
            </div><!-- /col-lg-4 -->
        </div>
    </div>
</section>

<!-- LIGHTBOX -->
<div id="lightbox" class="lightbox" aria-hidden="true">
    <span class="close" role="button" aria-label="Fechar">&times;</span>
    <img class="lightbox-content" id="lightbox-img" alt="Imagem do imóvel em tela cheia">
    <button class="lightbox-prev" type="button" aria-label="Imagem anterior">&#10094;</button>
    <button class="lightbox-next" type="button" aria-label="Próxima imagem">&#10095;</button>
</div>
@endsection

@push('styles')
<style>
    .section-title{font-weight:700;margin-bottom:10px}
    .info-item{border-bottom:1px solid #eee;padding-bottom:8px;margin-bottom:8px}
    .feature-item{font-weight:500;display:flex;align-items:center;gap:6px}
    .feature-item i{color:var(--primary-color);font-size:18px}

    /* Galeria normal */
    .main-image { position: relative; }
    .gallery-prev, .gallery-next {
        position: absolute; top: 50%; transform: translateY(-50%);
        background: rgba(0,0,0,0.55); color: #fff; border: none;
        padding: 10px 15px; cursor: pointer; font-size: 22px; border-radius: 50%;
        line-height: 1;
    }
    .gallery-prev { left: 10px; }
    .gallery-next { right: 10px; }
    .thumbnail-image.active-thumbnail { outline: 3px solid var(--primary-color); outline-offset: 2px; }

    /* Lightbox */
    .lightbox {
        display: none; position: fixed; z-index: 1060;
        inset: 0; background: rgba(0,0,0,0.92);
        text-align: center;
    }
    .lightbox-content { max-width: 92%; max-height: 84%; margin: auto; display: block; }
    .lightbox .close { position: absolute; top: 18px; right: 28px; color: #fff; font-size: 40px; font-weight: 700; cursor: pointer; }
    .lightbox-prev, .lightbox-next {
        position: absolute; top: 50%; transform: translateY(-50%);
        background: rgba(255,255,255,0.2); color: #fff; border: none;
        padding: 14px; cursor: pointer; font-size: 30px; border-radius: 50%; line-height: 1;
    }
    .lightbox-prev { left: 30px; }
    .lightbox-next { right: 30px; }

    /* ===== Ajustes visuais pedidos ===== */
    /* Badge "Venda/Aluguel" no amarelo do tema */
    .property-type.badge{
        font-size: 1rem;
        padding: 8px 16px;
        font-weight: 700;
        border-radius: 999px;
        background-color: var(--primary-color) !important;   /* amarelo */
        color: var(--secondary-color) !important;            /* preto */
    }
    /* Valor em preto e estável */
    .property-price {
        color: #000 !important;
        font-size: 28px;
        font-weight: 700;
        display: block;
        background: transparent !important;
        position: static !important;
        margin: 0 0 4px 0;
        line-height: 1.2;
    }
    .price-section small { display: block; margin-top: 2px; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainImg    = document.querySelector('.main-display-img');
    const thumbs     = document.querySelectorAll('.thumbnail-image');
    const prevBtn    = document.querySelector('.gallery-prev');
    const nextBtn    = document.querySelector('.gallery-next');

    const lightbox   = document.getElementById('lightbox');
    const lightboxImg= document.getElementById('lightbox-img');
    const closeBtn   = document.querySelector('.lightbox .close');
    const lbPrev     = document.querySelector('.lightbox-prev');
    const lbNext     = document.querySelector('.lightbox-next');

    const images = (thumbs.length
        ? Array.from(thumbs).map(t => t.src)
        : (mainImg ? [mainImg.src] : [])
    );

    let currentIndex = 0;

    function render() {
        if (!images.length || !mainImg) return;
        mainImg.src = images[currentIndex];
        thumbs.forEach(t => t.classList.toggle('active-thumbnail', Number(t.dataset.index) === currentIndex));
        if (lightbox.style.display === 'block') {
            lightboxImg.src = images[currentIndex];
        }
    }

    function openLightbox() {
        if (!images.length) return;
        lightbox.style.display = 'block';
        lightbox.setAttribute('aria-hidden', 'false');
        lightboxImg.src = images[currentIndex];
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.style.display = 'none';
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    thumbs.forEach(t => {
        t.addEventListener('click', () => {
            currentIndex = Number(t.dataset.index) || 0;
            render();
            openLightbox();
        });
    });

    if (prevBtn && nextBtn && images.length > 1) {
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            render();
        });
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            render();
        });
    }

    if (mainImg) {
        mainImg.addEventListener('click', openLightbox);
    }

    lbPrev.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        render();
    });
    lbNext.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        render();
    });
    closeBtn.addEventListener('click', closeLightbox);

    document.addEventListener('keydown', (e) => {
        if (lightbox.style.display === 'block') {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') lbNext.click();
            if (e.key === 'ArrowLeft')  lbPrev.click();
        } else {
            if (e.key === 'ArrowRight' && nextBtn) nextBtn.click();
            if (e.key === 'ArrowLeft'  && prevBtn) prevBtn.click();
        }
    });

    render();
});
</script>

@if($imovel->latitude && $imovel->longitude)
<script>
function initMap() {
    var location = { lat: {{ $imovel->latitude }}, lng: {{ $imovel->longitude }} };
    var map = new google.maps.Map(document.getElementById('map'), { zoom: 16, center: location });
    new google.maps.Marker({ position: location, map: map, title: "{{ $imovel->titulo }}" });
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=SUA_GOOGLE_MAPS_API_KEY&callback=initMap"></script>
@endif
@endpush
