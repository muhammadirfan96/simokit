<?php

namespace App\Models;

class Array_daftarSopIk
{
    private $peralatan = [
        'boiler' => ["sootblower", "slagcooler", "primary air fan", "secondary air fan", "induced draft fan", "high primary fluidized fan", "hydro test", "supply oil pump", "coal feeder", "tombol discharge valve slagcooler", "filling steam drum", "boiler auxilliary", "lower burner", "furnace purging", "pengoperasian lime stone", "warming up auxilliary boiler", "feeding material bed"],

        'turbin' => ["rubber ball cleaning", "travelling screen dan screen wash pump", "feed water pump", "HP oil pump", "condensate extrantion pump", "C.O. supply system pendingin bantu", "circulating water pump", "DC oil pump", "CCS", "AC oil pump", "close circulating water pump", "jacking oil pump", "turning gear", "vacum pump", "sea water pretreatment", "uap perapat poros turbin", "drain pit pump", "digital electric hydraulic", "CWP connecting valve", "operasi 3 CWP", "emergency MOV debris filter", "runback", "C.O. EH oil pump", "filter system", "C.O. CWP Dengan Operasi 3 CWP", "pengatur beban"],

        'alba' => ["emergency pengoperasian transporter", "conveying air compressor", "fast cut common PS", "supply tegangan UAT unit 2 ke unit 1", "warming up EDG", "operasi manual EDG", "pengetesan manual EDG", "IN rack OUT switchgear 400 V", "IN rack OUT switchgear 6 KV", "rack IN switchgear 400 V", "rack IN switchgear 6 KV", "AC central", "fire fighting system"],

        'startUp' => ["start up boiler hot state", "start up boiler warm state", "start up boiler cold state", "start up turbin extremely hot state", "start up turbin hot state", "start up turbin warm state", "start up turbin cold state", "syncron"],

        'shutDown' => ["shut down boiler", "shut down turbin", "lepas syncron"]
    ];

    public function semuaPeralatan()
    {
        return $this->peralatan;
    }
}
