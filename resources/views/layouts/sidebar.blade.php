<!-- Estilos mejorados para navbar siguiendo DESIGN_GUIDELINES.md -->
<style>
/* ===== NAVBAR ELEGANTE Y LIMPIO ===== */
.navbar-vertical {
  background: white !important;                    /* ✅ Fondo blanco limpio */
  border-right: 1px solid #dee2e6 !important;     /* ✅ Borde sutil */
  box-shadow: 2px 0 8px rgba(0,0,0,0.08) !important; /* ✅ Sombra suave */
  width: 250px !important;                         /* ✅ Ancho fijo siempre expandido */
  min-width: 250px !important;                     /* ✅ Evitar colapso */
}

.navbar-vertical-content {
  padding: 1.5rem 0;
}

.navbar-vertical-content > ul > li:first-child .nav-item-wrapper {
  margin-top: 1.5rem !important;
  margin-bottom: 1rem !important;
}

/* ===== ITEMS DE NAVEGACIÓN LIMPIOS ===== */
.nav-item-wrapper {
  margin: 0.25rem 0.75rem;
}

.nav-link {
  border-radius: 10px !important;                 /* ✅ Bordes redondeados suaves */
  padding: 0.75rem 1rem !important;
  margin: 0.125rem 0 !important;
  transition: all 0.2s ease !important;
  color: #6c757d !important;                      /* ✅ Texto neutro */
  font-weight: 500 !important;
  border: none !important;
}

.nav-link:hover {
  background: #f8f9fa !important;                 /* ✅ Fondo sutil en hover */
  color: #495057 !important;                      /* ✅ Texto legible */
  transform: none !important;                     /* ❌ Sin animaciones excesivas */
  box-shadow: 0 2px 4px rgba(0,0,0,0.05) !important; /* ✅ Sombra sutil */
}

.nav-link.active,
.nav-link[aria-expanded="true"] {
  background: white !important;                   /* ✅ Fondo blanco */
  color: #495057 !important;                      /* ✅ Texto neutro */
  border-left: 3px solid #0d6efd !important;     /* ✅ Indicador azul sutil */
  box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; /* ✅ Sombra consistente */
}

/* ===== ICONOS Y TEXTO LIMPIOS ===== */
.nav-link-icon {
  display: none !important; /* ❌ Ocultar iconos data-feather duplicados */
}

.nav-link-text {
  font-size: 0.875rem;
  font-weight: 500;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 200px;
}

/* ===== DETECCIÓN DE RUTA ACTIVA ===== */
.nav-link.current-route {
  background: #e3f2fd !important;                 /* ✅ Fondo azul suave */
  color: #1976d2 !important;                      /* ✅ Texto azul */
  border-left: 4px solid #1976d2 !important;     /* ✅ Borde azul fuerte */
  font-weight: 600 !important;
  box-shadow: 0 2px 8px rgba(25, 118, 210, 0.15) !important;
}

.parent .nav-link.current-route {
  background: #e8f5e9 !important;                 /* ✅ Verde suave para submenús */
  color: #2e7d32 !important;
  border-left: 3px solid #2e7d32 !important;
  font-weight: 600 !important;
}

/* ===== DROPDOWNS LIMPIOS ===== */
.dropdown-indicator-icon {
  color: #adb5bd !important;
  transition: transform 0.2s ease;
}

.nav-link[aria-expanded="true"] .dropdown-indicator-icon {
  transform: rotate(90deg);
  color: #0d6efd !important;
}

/* ===== SUBMENÚS ELEGANTES ===== */
.parent-wrapper .nav {
  background: #f8f9fa !important;                 /* ✅ Fondo sutil para submenús */
  border-radius: 8px !important;
  margin: 0.25rem 0.75rem !important;
  padding: 0.5rem 0 !important;
  border: 1px solid #e9ecef !important;           /* ✅ Borde sutil */
}

.parent .nav-link {
  font-size: 0.8125rem !important;
  padding: 0.5rem 1.5rem !important;
  color: #6c757d !important;
  border-radius: 6px !important;
  margin: 0.125rem 0.5rem !important;
}

.parent .nav-link-text {
  max-width: 180px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.parent .nav-link:hover {
  background: white !important;                   /* ✅ Fondo blanco en hover */
  color: #495057 !important;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
}

/* ===== SEPARADORES LIMPIOS ===== */
.navbar-vertical-line {
  border-color: #e9ecef !important;               /* ✅ Línea sutil */
  margin: 1rem 1.5rem !important;
}

/* ===== FOOTER DEL SIDEBAR LIMPIO ===== */
.navbar-vertical-footer {
  border-top: 1px solid #dee2e6 !important;      /* ✅ Borde sutil superior */
  padding: 1rem !important;
  background: white !important;                   /* ✅ Fondo blanco */
}

.navbar-vertical-toggle {
  background: #f8f9fa !important;                 /* ✅ Fondo sutil */
  color: #6c757d !important;                      /* ✅ Texto neutro */
  border: 1px solid #dee2e6 !important;          /* ✅ Borde consistente */
  border-radius: 8px !important;
  font-size: 0.8125rem !important;
  padding: 0.5rem !important;
}

.navbar-vertical-toggle:hover {
  background: white !important;                   /* ✅ Fondo blanco en hover */
  color: #495057 !important;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
}

/* ===== PREVENIR COLAPSO ===== */
.navbar-compact {
  width: 250px !important;                         /* ✅ Mantener ancho fijo */
  min-width: 250px !important;                     /* ✅ No comprimir nunca */
}

/* ===== RESPONSIVE Y MOBILE ===== */
@media (max-width: 992px) {
  .navbar-vertical {
    box-shadow: none !important;
    border-right: none !important;
    border-bottom: 1px solid #dee2e6 !important;
  }

  .navbar-compact {
    width: 100% !important; /* En mobile no comprimir */
  }
}
</style>

<nav class="navbar navbar-vertical navbar-expand-lg">
        <script>
          var navbarStyle = window.config.config.phoenixNavbarStyle;
          if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
          }
        </script>
        <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
          <!-- scrollbar removed-->
          <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
              <li class="nav-item">
                <!-- Inicio -->
                <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1 {{ request()->routeIs('dashboard') ? 'current-route' : '' }}" href="{{route('dashboard')}}" data-tooltip="Inicio">
                    <div class="d-flex align-items-center">
                      <div class="dropdown-indicator-icon"></div><span class="nav-link-text">🏠 Inicio</span>
                    </div>
                  </a>

                </div>
              </li>


              <li class="nav-item">

                <hr class="navbar-vertical-line" />


                <!-- parent pages-->

                <!-- parent pages-->
             @if(auth()->user()->usertype !='driver')
                <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1 {{ request()->routeIs('admin.allsalereps') || request()->routeIs('admin.act_log') ? 'current-route' : '' }}" href="#nv-umgt" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.allsalereps') || request()->routeIs('admin.act_log') ? 'true' : 'false' }}" aria-controls="nv-tables" data-tooltip="Gestión de Usuarios">
                    <div class="d-flex align-items-center">
                      <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-text">👥 Gestión de Usuarios</span>
                    </div>
                  </a>
                  <div class="parent-wrapper label-1">
<ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-umgt">

<li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.allsalereps') ? 'current-route' : '' }}" href="{{route('admin.allsalereps')}}" data-bs-toggle="" aria-expanded="false">
  <div class="d-flex align-items-center"><span class="nav-link-text">👤 Usuarios</span> </div> </a>
</li>
<li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.act_log') ? 'current-route' : '' }}" href="{{route('admin.act_log')}}">
          <div class="d-flex align-items-center"><span class="nav-link-text">📋 Registro de Actividad</span>
          </div>
                              </a>
                            </li>

</ul>
                  </div>
                </div>
            @endif
                <!-- parent pages-->

               <div class="nav-item-wrapper">
                <a class="nav-link label-1 {{ request()->routeIs('admin.allcustomers') ? 'current-route' : '' }}" href="{{route('admin.allcustomers')}}" role="button" data-bs-toggle="" aria-expanded="false" data-tooltip="Pedidos">
                    <div class="d-flex align-items-center">
                    <span class="nav-link-text">🛒 Pedidos</span>
                    </div>
                  </a>
                </div>

               <div class="nav-item-wrapper">
                <a class="nav-link label-1 {{ request()->routeIs('admin.allcustomerfeedback') ? 'current-route' : '' }}" href="{{route('admin.allcustomerfeedback')}}" role="button" data-bs-toggle="" aria-expanded="false" data-tooltip="Comentarios">
                    <div class="d-flex align-items-center">
                    <span class="nav-link-text">💬 Comentarios de Clientes</span>
                    </div>
                  </a>
                </div>


 @if(auth()->user()->usertype !='driver')
             <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1 {{ request()->routeIs('admin.delivery') || request()->routeIs('promotion') || request()->routeIs('dslots') ? 'current-route' : '' }}" href="#nv-board" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.delivery') || request()->routeIs('promotion') || request()->routeIs('dslots') ? 'true' : 'false' }}" aria-controls="nv-board" data-tooltip="Configuraciones">
                    <div class="d-flex align-items-center">
                      <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-text">⚙️ Configuraciones</span>
                    </div>
                  </a>
                  <div class="parent-wrapper label-1">
                    <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-board">


           <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.delivery') ? 'current-route' : '' }}" href="{{route('admin.delivery')}}" data-bs-toggle="" aria-expanded="false">
        <div class="d-flex align-items-center"><span class="nav-link-text">🚚 Tarifas de Entrega</span>
        </div>
        </a>
      </li>




   <li class="nav-item"><a class="nav-link {{ request()->routeIs('promotion') ? 'current-route' : '' }}" href="{{route('promotion')}}" data-bs-toggle="" aria-expanded="false">
        <div class="d-flex align-items-center"><span class="nav-link-text">🎫 Promociones</span>
        </div>
      </a>
    </li>

    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dslots') ? 'current-route' : '' }}" href="{{route('dslots')}}" data-bs-toggle="" aria-expanded="false">
        <div class="d-flex align-items-center"><span class="nav-link-text">🕐 Horarios de Entrega</span>
        </div>
      </a>
    </li>


                    </ul>
                  </div>
                </div>


               <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1 {{ request()->routeIs('admin.modules') || request()->routeIs('admin.product') || request()->routeIs('admin.stock') || request()->routeIs('admin.inventory') ? 'current-route' : '' }}" href="#nv-temp" role="button" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.modules') || request()->routeIs('admin.product') || request()->routeIs('admin.stock') || request()->routeIs('admin.inventory') ? 'true' : 'false' }}" aria-controls="nv-temp" data-tooltip="Catálogo">
                    <div class="d-flex align-items-center">
                      <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-text">📦 Catálogo</span>
                    </div>
                  </a>
                  <div class="parent-wrapper label-1">
                    <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-temp">




          <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.modules') ? 'current-route' : '' }}" href="{{route('admin.modules')}}" data-bs-toggle="" aria-expanded="false">
        <div class="d-flex align-items-center"><span class="nav-link-text">🗂️ Categorías de Productos</span>
        </div>
      </a>
    </li>


          <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.product') ? 'current-route' : '' }}" href="{{route('admin.product')}}" data-bs-toggle="" aria-expanded="false">
              <div class="d-flex align-items-center"><span class="nav-link-text">🥛 Productos</span>
              </div>
            </a>
          </li>

            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.stock') ? 'current-route' : '' }}" href="{{route('admin.stock')}}" data-bs-toggle="" aria-expanded="false">
              <div class="d-flex align-items-center"><span class="nav-link-text">📈 Compra de Inventario</span>
              </div>
            </a>
          </li>


             {{-- <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.inventory') ? 'current-route' : '' }}" href="{{route('admin.inventory')}}" data-bs-toggle="" aria-expanded="false">
              <div class="d-flex align-items-center"><span class="nav-link-text">📊 Inventario Actual</span>
              </div>
            </a>
          </li> --}}


                          </ul>
                    </ul>
                  </div>
                </div>


           @endif




              </li>

            </ul>
          </div>
        </div>
        <!-- Footer comentado para mantener siempre la barra expandida -->
        <!--
        <div class="navbar-vertical-footer">
          <button class="btn navbar-vertical-toggle border-0 fw-semi-bold w-100 white-space-nowrap d-flex align-items-center"><span class="uil uil-left-arrow-to-left fs-0"></span><span class="uil uil-arrow-from-right fs-0"></span><span class="navbar-vertical-footer-text ms-2">Vista Compacta</span></button>
        </div>
        -->
      </nav>

<!-- JavaScript para mantener submenús abiertos -->
<script>
// FORZAR SUBMENÚS ABIERTOS - EJECUTAR INMEDIATAMENTE
(function() {
    const currentUrl = window.location.href;
    console.log('Current URL:', currentUrl);

    function forceOpen(menuId) {
        const menu = document.getElementById(menuId);
        if (menu) {
            menu.classList.add('show');
            console.log(`✅ Forzado: ${menuId} abierto`);
        }
    }

    // Detectar y forzar abrir submenús según la URL actual
    @if(request()->routeIs('admin.allsalereps') || request()->routeIs('admin.act_log'))
        forceOpen('nv-umgt');
    @endif

    @if(request()->routeIs('admin.delivery') || request()->routeIs('promotion') || request()->routeIs('dslots'))
        forceOpen('nv-board');
    @endif

    @if(request()->routeIs('admin.modules') || request()->routeIs('admin.product') || request()->routeIs('admin.stock') || request()->routeIs('admin.inventory'))
        forceOpen('nv-temp');
    @endif

})();

// MANTENER SUBMENÚS ABIERTOS - Ejecutar después del DOM
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Configurando submenús...');

    // Prevenir que los submenús se cierren automáticamente
    const collapseElements = document.querySelectorAll('.collapse.parent');

    collapseElements.forEach(function(collapse) {
        @if(request()->routeIs('admin.allsalereps') || request()->routeIs('admin.act_log'))
            if (collapse.id === 'nv-umgt') {
                collapse.classList.add('show');
            }
        @endif

        @if(request()->routeIs('admin.delivery') || request()->routeIs('promotion') || request()->routeIs('dslots'))
            if (collapse.id === 'nv-board') {
                collapse.classList.add('show');
            }
        @endif

        @if(request()->routeIs('admin.modules') || request()->routeIs('admin.product') || request()->routeIs('admin.stock') || request()->routeIs('admin.inventory'))
            if (collapse.id === 'nv-temp') {
                collapse.classList.add('show');
            }
        @endif
    });

    console.log('✅ Submenús configurados correctamente');
});
</script>
