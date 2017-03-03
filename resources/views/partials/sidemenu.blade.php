<nav class="pushy pushy-left">
  <div class="text-center webgs-brand">
    Web GS - ERP
  </div>
  <div class="row text-center" style="margin-bottom: 15px; margin-top:15px;">
    <img src="{{url('admin/config/img_destaque')}}" class="img-circle" height="200">
  </div>
  <ul class="menu" >
    <li class="pushy-submenu {{{ Request::path()=='/' ? "active" : "" }}}">
      <a href="{{ url('/') }}"><i class="fa fa-dashboard fa-lg"></i> Painel</a>
    </li>
    <li class="pushy-submenu ">
        <a href="#" class="{{{ Request::is('novo*') ? "active" : ""}}}"><i class="fa fa-file-text fa-lg"></i> Cadastros</a>
        <ul class="menu" >
          <li class="pushy-link "><a class="{{{ Request::path()=='novo/contatos' ? "active" : "" }}}" href="{{ url('novo/contatos') }}"><i class="fa fa-user"></i> Entidade</a></li>
          <li class="pushy-link "><a class="{{{ Request::path()=='novo/funcionarios' ? "active" : "" }}}" href="{{ url('novo/funcionarios') }}"><i class="fa fa-user-plus"></i> Funcionario</a></li>
          @if ($modulo_atendimentos=="1")
            <li class="pushy-link "><a class="{{{ Request::path()=='novo/atendimentos' ? "active" : "" }}}" href="{{ url('/novo/atendimentos') }}"><i class="fa fa-list"></i> Atendimento</a></li>
          @endif
          @if ($modulo_contas=="1")
            <li class="pushy-link "><a class="{{{ Request::path()=='novo/contas' ? "active" : "" }}}" href="{{ url('/novo/contas') }}"><i class="fa fa-usd"></i> Plano bancario</a></li>
            <li class="pushy-link "><a class="{{{ Request::path()=='novo/consumos' ? "active" : "" }}}" href="{{ url('/novo/consumos') }}"><i class="fa fa-arrow-right"></i><i class="fa fa-usd"></i> Cosumo bancario</a></li>
          @endif
          @if ($modulo_estoques=="1")
            <li class="pushy-link "><a class="{{{ Request::path()=='novo/estoque' ? "active" : "" }}}" href="{{ url('/novo/estoque') }}"><i class="fa fa-bell"></i> Novo produto</a></li>
          @endif
          @if ($modulo_caixas=="1")
            <li class="pushy-link "><a class="{{{ Request::path()=='novo/caixa' ? "active" : "" }}}" href="{{ url('/novo/caixa') }}"><i class="fa fa-money"></i> Movimento de Caixa</a></li>
          @endif
          <li class="pushy-link "><a class="{{{ Request::path()=='novo/bancos' ? "active" : "" }}}" href="{{ url('/novo/bancos') }}"><i class="fa fa-bank"></i> Conta Bancaria</a></li>
          @if ($modulo_vendas=="1")
            <li class="pushy-link "><a class="{{{ Request::path()=='novo/vendas' ? "active" : "" }}}" href="{{ url('/novo/vendas') }}"><i class="fa fa-shopping-cart"></i> Vendas</a></li>
          @endif
          @if ($modulo_frotas=="1")
            <li class="pushy-link "><a class="{{{ Request::path()=='novo/frotas' ? "active" : "" }}}" href="{{ url('/novo/frotas') }}"><i class="fa fa-car"></i> Adicionar veiculo</a></li>
          @endif
          @if ($modulo_tickets=="1")
            <li class="pushy-link "><a class="{{{ Request::path()=='novo/tickets' ? "active" : "" }}}" href="{{ url('/novo/tickets') }}"><i class="fa fa-book"></i> Tickets</a></li>
          @endif
        </ul class="menu" >
    </li>
    <li class="pushy-submenu ">
        <a href="#" class="{{{ Request::is('lista*') ? "active" : ""}}}"><i class="fa fa-list fa-lg"></i> Listas</a>
        <ul class="menu" >
          <li class="pushy-link"><a class="{{{ Request::path()=='lista/contatos' ? "active" : "" }}}" href="{{ url('/lista/contatos') }}"><i class="fa fa-user"></i> Entidades</a></li>
          @if ($modulo_atendimentos=="1")
            <li class="pushy-link"><a class="{{{ Request::path()=='lista/atendimentos' ? "active" : "" }}}" href="{{ url('/lista/atendimentos') }}"><i class="fa fa-list"></i> Atendimento</a></li>
          @endif
          @if ($modulo_contas=="1")
            <li class="pushy-link"><a class="{{{ Request::path()=='lista/contas' ? "active" : "" }}}" href="{{ url('/lista/contas') }}"><i class="fa fa-usd"></i> Historico bancario</a></li>
          @endif
          @if ($modulo_estoques=="1")
            <li class="pushy-link"><a class="{{{ Request::path()=='lista/estoque' ? "active" : "" }}}" href="{{ url('/lista/estoque') }}"><i class="fa fa-bell"></i> Estoque</a></li>
          @endif
          @if ($modulo_caixas=="1")
            <li class="pushy-link"><a class="{{{ Request::path()=='lista/caixa' ? "active" : "" }}}" href="{{ url('/lista/caixa') }}"><i class="fa fa-money"></i> Movimentações e Caixas</a></li>
          @endif
          <li class="pushy-link"><a class="{{{ Request::path()=='lista/bancos' ? "active" : "" }}}" href="{{ url('/lista/bancos') }}"><i class="fa fa-bancos"></i> Contas em bancos</a></li>
          @if ($modulo_vendas=="1")
            <li class="pushy-link"><a class="{{{ Request::path()=='lista/vendas' ? "active" : "" }}}" href="{{ url('/lista/vendas') }}"><i class="fa fa-shopping-cart"></i> Vendas</a></li>
          @endif
          @if ($modulo_frotas=="1")
            <li class="pushy-link"><a class="{{{ Request::path()=='lista/frotas' ? "active" : "" }}}" href="{{ url('/lista/frotas') }}"><i class="fa fa-car"></i> Frotas</a></li>
          @endif
          @if ($modulo_tickets=="1")
            <li class="pushy-link"><a class="{{{ Request::path()=='lista/tickets' ? "active" : "" }}}" href="{{ url('/lista/tickets') }}"><i class="fa fa-book"></i> Tickets</a></li>
          @endif
        </ul class="menu" >
    </li>
    @if (isset(Auth::user()->perms["admin"]) and Auth::user()->perms["admin"]==1)
      <li class="pushy-submenu {{{ Request::is('admin*') ? "active" : ""}}}">
          <a href="#"><i class="fa fa-wrench fa-lg"></i> Controle</a>
          <ul class="menu" >
            <li class="pushy-link"><a class="{{{ Request::path()=='admin/config' ? "active" : "" }}}" href="{{ url('/admin/config') }}">Configurações</a></li>
            <li class="pushy-link"><a class="{{{ Request::path()=='admin' ? "active" : "" }}}" href="{{ url('/admin') }}">Controle de Usuarios</a></li>
            <li class="pushy-link"><a class="{{{ Request::path()=='admin/update' ? "active" : "" }}}" href="{{ url('/admin/update') }}">Atualizar</a></li>
            <li class="pushy-link"><a class="{{{ Request::path()=='admin/backup' ? "active" : "" }}}" href="{{ url('/admin/backup') }}">Backup</a></li>
            <li class="pushy-link"><a class="{{{ Request::path()=='admin/logs' ? "active" : "" }}}" href="{{ url('/admin/logs') }}">Logs</a></li>
          </ul class="menu" >
      </li>
      <li class="pushy-submenu {{{ Request::is('admin*') ? "active" : ""}}}">
          <a href="#"><i class="fa fa-file-o fa-lg"></i> Combobox</a>
          <ul class="menu" >
            <li class="pushy-link"><a class="{{{ Request::path()=='admin/Combobox' ? "active" : "" }}}" href="{{ url('/admin/combobox') }}"><i class="fa fa-gear"></i> Painel</a></li>
            <li class="pushy-link "><a class="{{{ Request::path()=='novo/combobox/telefone' ? "active" : "" }}}" href="{{ url('novo/combobox/telefone') }}"><i class="fa fa-phone"></i> Tipo de telefone</a></li>
            <li class="pushy-link "><a class="{{{ Request::path()=='novo/combobox/relacao' ? "active" : "" }}}" href="{{ url('novo/combobox/relacao') }}"><i class="fa fa-share-square"></i> Relacionamento</a></li>
            @if ($modulo_atendimentos=="1")
              <li class="pushy-link "><a class="{{{ Request::path()=='novo/combobox/atend' ? "active" : "" }}}" href="{{ url('novo/combobox/atend') }}"><i class="fa fa-list"></i> Assunto de Atend.</a></li>
            @endif
            @if ($modulo_contas=="1")
              <li class="pushy-link "><a class="{{{ Request::path()=='novo/combobox/contas' ? "active" : "" }}}" href="{{ url('novo/combobox/contas') }}"><i class="fa fa-usd"></i> Ref. para Contas</a></li>
              <li class="pushy-link "><a class="{{{ Request::path()=='novo/combobox/consumos' ? "active" : "" }}}" href="{{ url('novo/combobox/consumos') }}"><i class="fa fa-arrow-right"></i><i class="fa fa-usd"></i> Ref. de Consumo</a></li>
            @endif
            @if ($modulo_caixas=="1" or $modulo_contas=="1")
              <li class="pushy-link "><a class="{{{ Request::path()=='novo/combobox/formas' ? "active" : "" }}}" href="{{ url('novo/combobox/formas') }}"><i class="fa fa-money"></i> Forma de pagamentos</a></li>
            @endif
            @if ($modulo_caixas=="1")
              <li class="pushy-link "><a class="{{{ Request::path()=='novo/combobox/caixas' ? "active" : "" }}}" href="{{ url('novo/combobox/caixas') }}"><i class="fa fa-list"></i> Desc. movimentação</a></li>
            @endif
          </ul class="menu" >
      </li>
    @endif
  </ul class="menu" >
 </nav>
