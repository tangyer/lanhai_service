<?php

namespace app\common\provider\pay\bank\QePay;

class MXN {
	// 墨西哥
	public static $bankList = [
		[
			"code" => "MXNSTP",
			"name" => "STP"
		],
		[
			"code" => "MXNCLS",
			"name" => "CLS"
		],
		[
			"code" => "MXNGBM",
			"name" => "GBM"
		],
		[
			"code" => "MXNHSBC",
			"name" => "HSBC"
		],
		[
			"code" => "MXNICBC",
			"name" => "ICBC"
		],
		[
			"code" => "MXNMUFG",
			"name" => "MUFG"
		],
		[
			"code" => "MXNAKALA",
			"name" => "AKALA"
		],
		[
			"code" => "MXNBAJIO",
			"name" => "BAJIO"
		],
		[
			"code" => "MXNBANSI",
			"name" => "BANSI"
		],
		[
			"code" => "MXNBBASE",
			"name" => "BBASE"
		],
		[
			"code" => "MXNCLABE",
			"name" => "CLABE"
		],
		[
			"code" => "MXNDONDE",
			"name" => "DONDE"
		],
		[
			"code" => "MXNINVEX",
			"name" => "INVEX"
		],
		[
			"code" => "MXNMIFEL",
			"name" => "MIFEL"
		],
		[
			"code" => "MXNNAFIN",
			"name" => "NAFIN"
		],
		[
			"code" => "MXNVALUE",
			"name" => "VALUE"
		],
		[
			"code" => "MXNAZTECA",
			"name" => "AZTECA"
		],
		[
			"code" => "MXNAFIRME",
			"name" => "AFIRME"
		],
		[
			"code" => "MXNBMONEX",
			"name" => "BMONEX"
		],
		[
			"code" => "MXNFOMPED",
			"name" => "FOMPED"
		],
		[
			"code" => "MXNKUSPIT",
			"name" => "KUSPIT"
		],
		[
			"code" => "MXNMASARI",
			"name" => "MASARI"
		],
		[
			"code" => "MXNUNAGRA",
			"name" => "UNAGRA"
		],
		[
			"code" => "MXNVALMEX",
			"name" => "VALMEX"
		],
		[
			"code" => "MXNVECTOR",
			"name" => "VECTOR"
		],
		[
			"code" => "MXNBANAMEX",
			"name" => "BANAMEX"
		],
		[
			"code" => "MXNBANORTE",
			"name" => "BANORTE"
		],
		[
			"code" => "MXNAUTOFIN",
			"name" => "AUTOFIN"
		],
		[
			"code" => "MXNBANCREA",
			"name" => "BANCREA"
		],
		[
			"code" => "MXNBANSEFI",
			"name" => "BANSEFI"
		],
		[
			"code" => "MXNBANXICO",
			"name" => "BANXICO"
		],
		[
			"code" => "MXNCIBANCO",
			"name" => "CIBANCO"
		],
		[
			"code" => "MXNFINAMEX",
			"name" => "FINAMEX"
		],
		[
			"code" => "MXNINBURSA",
			"name" => "INBURSA"
		],
		[
			"code" => "MXNINDEVAL",
			"name" => "INDEVAL"
		],
		[
			"code" => "MXNMONEXCB",
			"name" => "MONEXCB"
		],
		[
			"code" => "MXNREFORMA",
			"name" => "REFORMA"
		],
		[
			"code" => "MXNSHINHAN",
			"name" => "SHINHAN"
		],
		[
			"code" => "MXNBANCOS3",
			"name" => "BANCO S3"
		],
		[
			"code" => "MXNCIBOLSA",
			"name" => "CI BOLSA"
		],
		[
			"code" => "MXNACTINVER",
			"name" => "ACTINVER"
		],
		[
			"code" => "MXNBANKAOOL",
			"name" => "BANKAOOL"
		],
		[
			"code" => "MXNBANOBRAS",
			"name" => "BANOBRAS"
		],
		[
			"code" => "MXNBARCLAYS",
			"name" => "BARCLAYS"
		],
		[
			"code" => "MXNDEUTSCHE",
			"name" => "DEUTSCHE"
		],
		[
			"code" => "MXNEVERCORE",
			"name" => "EVERCORE"
		],
		[
			"code" => "MXNFINCOMUN",
			"name" => "FINCOMUN"
		],
		[
			"code" => "MXNINVERCAP",
			"name" => "INVERCAP"
		],
		[
			"code" => "MXNBANREGIO",
			"name" => "BANREGIO"
		],
		[
			"code" => "MXNLIBERTAD",
			"name" => "LIBERTAD"
		],
		[
			"code" => "MXNPAGATODO",
			"name" => "PAGATODO"
		],
		[
			"code" => "MXNSABADELL",
			"name" => "SABADELL"
		],
		[
			"code" => "MXNTRANSFER",
			"name" => "TRANSFER"
		],
		[
			"code" => "MXNJPMORGAN",
			"name" => "JP MORGAN"
		],
		[
			"code" => "MXNBANCOPPEL",
			"name" => "BANCOPPEL"
		],
		[
			"code" => "MXNSANTANDER",
			"name" => "SANTANDER"
		],
		[
			"code" => "MXNVEPORMAS",
			"name" => "VE POR MAS"
		],
		[
			"code" => "MXNBANCOMEXT",
			"name" => "BANCOMEXT"
		],
		[
			"code" => "MXNPROFUTURO",
			"name" => "PROFUTURO"
		],
		[
			"code" => "MXNBANJERCITO",
			"name" => "BANJERCITO"
		],
		[
			"code" => "MXNSCOTIABANK",
			"name" => "SCOTIABANK"
		],
		[
			"code" => "MXNVOLKSWAGEN",
			"name" => "VOLKSWAGEN"
		],
		[
			"code" => "MXNABCCAPITAL",
			"name" => "ABC CAPITAL"
		],
		[
			"code" => "MXNCBINTERCAM",
			"name" => "CB INTERCAM"
		],
		[
			"code" => "MXNCoDiValida",
			"name" => "CoDi Valida"
		],
		[
			"code" => "MXNHDISEGUROS",
			"name" => "HDI SEGUROS"
		],
		[
			"code" => "MXNMIZUHOBANK",
			"name" => "MIZUHO BANK"
		],
		[
			"code" => "MXNCOMPARTAMOS",
			"name" => "COMPARTAMOS"
		],
		[
			"code" => "MXNFONDO(FIRA)",
			"name" => "FONDO (FIRA)"
		],
		[
			"code" => "MXNBBVABANCOMER",
			"name" => "BBVABANCOMER"
		],
		[
			"code" => "MXNCREDICAPITAL",
			"name" => "CREDICAPITAL"
		],
		[
			"code" => "MXNINMOBILIARIO",
			"name" => "INMOBILIARIO"
		],
		[
			"code" => "MXNCREDITSUISSE",
			"name" => "CREDIT SUISSE"
		],
		[
			"code" => "MXNMULTIVABANCO",
			"name" => "MULTIVA BANCO"
		],
		[
			"code" => "MXNACCENDOBANCO",
			"name" => "ACCENDO BANCO"
		],
		[
			"code" => "MXNBANCOFINTERRA",
			"name" => "BANCO FINTERRA"
		],
		[
			"code" => "MXNINTERCAMBANCO",
			"name" => "INTERCAM BANCO"
		],
		[
			"code" => "MXNMULTIVACBOLSA",
			"name" => "MULTIVA CBOLSA"
		],
		[
			"code" => "MXNCAJAPOPMEXICA",
			"name" => "CAJA POP MEXICA"
		],
		[
			"code" => "MXNASPINTEGRAOPC",
			"name" => "ASP INTEGRA OPC"
		],
		[
			"code" => "MXNBANKOFAMERICA",
			"name" => "BANK OF AMERICA"
		],
		[
			"code" => "MXNAMERICANEXPRES",
			"name" => "AMERICAN EXPRES"
		],
		[
			"code" => "MXNCAJATELEFONIST",
			"name" => "CAJA TELEFONIST"
		],
		[
			"code" => "MXNCRISTOBALCOLON",
			"name" => "CRISTOBAL COLON"
		],
		[
			"code" => "MXNHIPOTECARIAFED",
			"name" => "HIPOTECARIA FED"
		],
		[
			"code" => "MXNESTRUCTURADORES",
			"name" => "ESTRUCTURADORES"
		]
	];
}
