<?php

namespace Classes;

class Pagination
{
    public $current_page;
    public $logs_per_page;
    public $total_logs;

    public function __construct($current_page = 1, $logs_per_page = 10, $total_logs = 0)
    {
        // Casteamos (castear es cambiar el tipo de dato) el valor, para que sea un entero, por si llega como string
        $this->current_page = (int) $current_page;
        $this->logs_per_page = (int) $logs_per_page;
        $this->total_logs = (int) $total_logs;
    }

    // Calculate offset - registros a omitir a la hora de realizar la busqueda
    // En la pagina 1 mostraríamos registros del 1 al 10, en la 2 del 11 al 20, en la 3 del 21 al 30 y asi (esto en el caso de que solo queramos mostrar 10 registros por pagina)
    public function offset()
    {
        // si estamos en la pagina 1, le restamos 1 para que quede 0, la cantidad de pagina por 0 nos dará 0, por lo que en la primer pagina no vamos a arrancar omitiendo ninguno registro sino que traemos desde el 0 la cantidad de registramos que hayas definido por pagina. luego en la pagina 2, traeremos x cantidad de registros siguientes desde la cantidad que ya cargamos actualmente. Es decir si trajimos 5 registros, en la siguiente traemos otros 5 pero arrancando desde el 5, osea mostramos hasta el 10, luego hasta el 15 y asi
        return $this->logs_per_page * ($this->current_page - 1);
    }

    public function total_pages()
    {
        // Ceil redondea para arriba, de esta forma si nos da un numero con coma tendremos un pagina más donde mostrar los sobrantes
        return ceil($this->total_logs / $this->logs_per_page);
    }


    // Retornamos la pagina anterior a la actual
    public function prev_page()
    {
        $prev = $this->current_page - 1;
        // Si el calculo de la pagina anterior es mayor a 0 retornamos la pagina sino un false
        return $prev > 0 ? $prev : false;
    }

    public function next_page()
    {
        $next = $this->current_page + 1;
        return $next <= $this->total_pages() ? $next : false;
    }

    public function prev_link()
    {
        $html = "";
        if ($this->prev_page()) {
            $html .= "<a class=\"pagination__link pagination__link-prev pagination__link--text \" href=\"?page={$this->prev_page()}\">&laquo; Anterior</a>";
        }
        return $html;
    }

    public function next_link()
    {
        $html = "";
        if ($this->next_page()) {
            $html .= "<a class=\"pagination__link pagination__link--text\" href=\"?page={$this->next_page()}\">Siguiente &raquo;</a>";
        }
        return $html;
    }

    public function nums_page()
    {
        $html = "";
        for ($i = 1; $i <= $this->total_pages(); $i++) {
            if ($this->current_page == $i) {
                $html .= "<span class=\"pagination__link pagination__link--current\">{$i}</span>";
            } else {
                $html .= "<a class=\"pagination__link pagination__link--num\" href=\"?page={$i}\">{$i}</a>";
            }
        }
        return $html;
    }

    public function pagination()
    {
        $html = "";

        if ($this->total_logs > 1) {
            $html .= "<div class = 'pagination'>";
            $html .= $this->prev_link();
            $html .= $this->nums_page();
            $html .= $this->next_link();
            $html .= "</div>";
        }

        return $html;
    }
}
