-- indicadore de produção mensal antecipados
SELECT [LOTE]
		      
		     ,sum([TOTAL]) as total
		  FROM [DB5624_GEOPC_COMPLEMEX].[dbo].[tbl_ANT_RELATORIO_TEMP_PRODUCAO] 
		  group by lote
		-- resultado
        -- LOTE	total
        -- 1/2019	215
        -- 10/2018	271
        -- 11/2018	223
        -- 12/2018	222
        -- 2/2019	227
        -- 3/2018	586
        -- 3/2019	298
        -- 4/2018	451
        -- 4/2019	310
        -- 5/2018	522

        -- op hoje analitico
        /****** Script do comando SelectTopNRows de SSMS  ******/
SELECT  [Numero]
      ,[Codigo Externo]
      ,[Cliente]
      ,[CPF/CNPJ do Cliente]
      ,[Moeda]
      ,[Valor M/E]
      ,[Banqueiro Correspondente]
      ,[Pagador]
      ,[Pais]
      ,convert(date,[DATA_ENVIO_OPE], 103) as DATA_ENVIO_OPE
      ,[DATA_CHEGADA_OPE]
      ,[CO_PV]
      ,[RESP_PV]
      ,[NO_PV]
      ,[NO_RESP_PV]
      ,[TP_PV]
  FROM [DB5624_GEOPC_COMPLEMEX].[dbo].[tbl_SIEXC_OPES_ENVIADAS]
  where convert(date,[DATA_ENVIO_OPE], 103) = convert(date, getdate(),103)
  -- resultado
--   Numero	Codigo Externo	Cliente	CPF/CNPJ do Cliente	Moeda	Valor M/E	Banqueiro Correspondente	Pagador	Pais	DATA_ENVIO_OPE	DATA_CHEGADA_OPE	CO_PV	RESP_PV	NO_PV	NO_RESP_PV	TP_PV
-- 1061944754	7394984	DANIEL DE OLIVEIRA CANDIDO	67.877.266/0001-98	USD	11382	CITIBANK NY - CITIUS33	TAI WAI NATIVE PRODUCTS COMPANY LTD	HONG KONG	2019-08-12	12/08/2019 10:8:26	1775	NULL	REGENTE FEIJO, SP                       	NULL	AG
-- 1062880801	7406432	BRASLAR DO BRASIL LTDA	04.016.420/0001-17	USD	44678,12	STANDARD CHARTERED - SCBLUS33	ROLE SOCIEDAD ANONIMA	PARAGUAI	2019-08-12	12/08/2019 17:11:27	3304	NULL	LAGOA DOURADA, PR                       	NULL	AG
-- 1062598925	7405988	GTN GRANITOS LTDA  EM RECUPERACAO JUDICIAL	03.400.379/0001-15	USD	11348,44	CITIBANK NY - CITIUS33	ARCHITECTURAL GRANITE AND MARBLE LL	ESTADOS UNIDOS	2019-08-12	12/08/2019 17:11:27	171	NULL	CACHOEIRO DE ITAPEMIRIM, ES             	NULL	AG
-- 1062884601	7406952	KATZ COMERCIO DE PRODUTOS ALIMENTICIOS LTDA	04.458.148/0001-25	USD	49920	CITIBANK NY - CITIUS33	MIX FOOD	MARROCOS	2019-08-12	12/08/2019 17:11:27	2885	C063498	ANHANGUERA DE SUMARE, SP                	CLAUDEMIR FANECO                        	AG
-- 1062880941	7406531	ELITE STONES COMERCIO EIRELI	23.603.138/0001-80	USD	3000	CITIBANK NY - CITIUS33	J F GRANITE   MARBLE LLC	ESTADOS UNIDOS	2019-08-12	12/08/2019 17:11:27	2440	NULL	BENTO FERREIRA, ES                      	NULL	AG
-- 1062314061	7401318	CANOINHAS ASSESSORIA E PLANEJAMENTO AGRO	02.609.038/0001-91	USD	6975	BOFA N.A. MIAMI - BOFAUS3M	GREENVALLEY INTERNATIONAL INC	ESTADOS UNIDOS	2019-08-12	12/08/2019 17:11:27	413	NULL	CANOINHAS, SC                           	NULL	AG
-- 1062542861	7405004	AGRODAN AGROPECUARIA RORIZ DANTAS LTDA	12.786.836/0001-42	EUR	33228,5	COMMERZBANK AG - COBADEFF	ROVEG FRUIT B.V.	PAISES BAIXOS	2019-08-12	12/08/2019 17:11:27	3515	C086768	SUAPE, PE                               	ANA CAROLINA JACOB CATUNDA              	AG
-- 1062884514	7406945	KATZ COMERCIO DE PRODUTOS ALIMENTICIOS LTDA	04.458.148/0001-25	USD	20105,5	CITIBANK NY - CITIUS33	SINDY INSUMOS ALIMENTICIOS SA	ARGENTINA	2019-08-12	12/08/2019 17:11:27	2885	C066575	ANHANGUERA DE SUMARE, SP                	ROBSON CARLOS DA COSTA                  	AG
-- 1062880904	7406507	INTERDESIGN MOVEIS LTDA	88.614.938/0001-42	USD	15000	STANDARD CHARTERED - SCBLUS33	ACCENTS BY DESIGN, INC	ESTADOS UNIDOS	2019-08-12	12/08/2019 17:11:27	2515	NULL	PLATAFORMA CORPORAT RIO GRANDE SUL      	NULL	PA
-- 1062884731	7406960	PARTNER INDUSTRIA E COMERCIO DE COUROS LTDA	02.866.513/0001-05	USD	93858,92	STANDARD CHARTERED - SCBLUS33	WHITE IND. CO., LTD.	BRASIL	2019-08-12	12/08/2019 17:11:27	2515	C087941	PLATAFORMA CORPORAT RIO GRANDE SUL      	MARCIELE SANTIN                         	PA

-- envio op quantidade

SELECT  count(Numero) as quantidadeOpHoje
  FROM [DB5624_GEOPC_COMPLEMEX].[dbo].[tbl_SIEXC_OPES_ENVIADAS]
  where convert(date,[DATA_ENVIO_OPE], 103) = convert(date, getdate(),103)

  -- resultado
  -- quantidadeOpHoje
  -- 30


-- consulta envio cliente
/****** Script do comando SelectTopNRows de SSMS  ******/
SELECT [COD_HISTORICO]
      ,[DATA_HISTORICO]
      ,[CNPJ]
      ,[ACAO]
      ,[HISTORICO]
      ,[COD_MATRICULA]
      ,[CO_PV]
  FROM [DB5624_GEOPC_COMPLEMEX].[dbo].[tbl_SIEXC_OPES_EMAIL_HISTORICO]
  where [ACAO] ='envio' and convert(date,[DATA_HISTORICO],103) = convert(date, getdate(),103)

  -- resultado
  -- COD_HISTORICO	DATA_HISTORICO	CNPJ	ACAO	HISTORICO	COD_MATRICULA	CO_PV
-- 1057	2019-08-12 17:29:08.327	12.786.836/0001-42	ENVIO	Ordem de Pagamento enviada (e-mail principal: paulo.dantas@agrodan.com.br; e-mail secundario: valdineide.lopes@agrodan.com.br e e-mail reserva: sem e-mail cadastrado).	CEOPC08	5459
-- 1058	2019-08-12 17:29:08.423	02.866.513/0001-05	ENVIO	Ordem de Pagamento enviada (e-mail principal: joaoland@curtumepartner.com.br; e-mail secundario: dpf@curtumepartner.com.br e e-mail reserva: sem e-mail cadastrado).	CEOPC08	5459
-- 1059	2019-08-12 17:29:08.543	04.458.148/0001-25	ENVIO	Ordem de Pagamento enviada (e-mail principal: financeiro@katzspices.com.br; e-mail secundario: sem e-mail cadastrado e e-mail reserva: sem e-mail cadastrado).	CEOPC08	5459

-- select op diaria cliente
SELECT count (COD_HISTORICO) as quantidadeOP
      
  FROM [DB5624_GEOPC_COMPLEMEX].[dbo].[tbl_SIEXC_OPES_EMAIL_HISTORICO]
  where [ACAO] ='envio' and convert(date,[DATA_HISTORICO],103) = convert(date, getdate(),103)

  -- resultado
--   quantidadeOP
--    5