@if (!isset($item['topnav']) || (isset($item['topnav']) && !$item['topnav']))
    @if (is_string($item))
        <li class="nav-header">{{ $item }}</li>
    @elseif (isset($item['header']))
        <li class="nav-header">{{ $item['header'] }}</li>
    @elseif (isset($item['search']) && $item['search'])
        <li>
            <form action="{{ $item['href'] }}" method="{{ $item['method'] }}" class="form-inline">
              <div class="input-group">
                <input class="form-control form-control-sidebar" type="text" name="{{ $item['input_name'] }}" placeholder="{{ $item['text'] }}" aria-label="{{ $item['aria-label'] ?? $item['text'] }}">
                <div class="input-group-append">
                  <button class="btn btn-sidebar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
        </li>
    @else
        @if (in_array(session()->get('acessoEmpregadoPortal'), $item['perfil_acesso']))
            <li class="nav-item @if (isset($item['submenu'])){{ $item['submenu_class'] }}@endif">
                <a class="nav-link {{ $item['class'] }}" href="{{ $item['href'] }}"
                @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
                >
                    <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
                    <p>
                        {{ $item['text'] }}

                        @if (isset($item['submenu']))
                            <i class="fas fa-angle-left right"></i>
                        @endif
                        @if (isset($item['label']))
                            <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">{{ $item['label'] }}</span>
                        @endif
                    </p>
                </a>
                @if (isset($item['submenu']))
                    <ul class="nav nav-treeview">
                        @each('adminlte::partials.menu-item', $item['submenu'], 'item')
                    </ul>
                @endif
            </li>
        @endif
    @endif
@endif
