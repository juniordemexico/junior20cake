-- QUERIES FACTURA IMPORTES, DESCUENTOS, ETC

/*
ALTER TABLE FACTURA ADD FAIMPORTE2 
COMPUTED BY ( CAST(((faSuma*(1-(CAST(faDesc1 AS FLOAT)/100)))*(1-(CAST(faDesc2 AS FLOAT)/100)))*(1-(CAST(faDesc3 AS FLOAT)/100)) AS NUMERIC(14,2)));
ALTER TABLE FACTURA ADD FAIMPOIMPU2 COMPUTED BY (CAST(faImporte*(CAST(faImpu AS FLOAT)/100) AS NUMERIC(14,2)));
ALTER TABLE FACTURA ADD FATOTAL2 COMPUTED BY ( CAST(faImpoImpu+faImporte AS NUMERIC(14,2)) );
*/

/*
ALTER TABLE FACTURADET ADD FADPRECIODESC2 COMPUTED BY (  CAST(( fadPrecio*(1-(CAST(fadDesc1 AS FLOAT)/100)) ) *(1-(CAST(fadDesc2 AS FLOAT)/100)) AS NUMERIC(14,2)));
ALTER TABLE FACTURADET ADD FADIMPORTE2 COMPUTED BY (CAST(fadPrecioDesc2*fadCant AS NUMERIC(14,2)));
ALTER TABLE FACTURADET ADD FADIMPOIMPU12 COMPUTED BY (CAST(fadImporte2*(CAST(fadImpu1 AS FLOAT)/100) AS NUMERIC(14,2)));
ALTER TABLE FACTURADET ADD FADIMPOIMPU22 COMPUTED BY (CAST(fadImporte2*(CAST(fadImpu2 AS FLOAT)/100) AS NUMERIC(14,2)));
*/

/*
ALTER TABLE FACTURADET 
DROP FADIMPOIMPU1,
DROP FADIMPOIMPU2,
DROP FADIMPORTE,
DROP FADPRECIODESC
*/

/*
ALTER TABLE FACTURADET ADD FADPRECIODESC COMPUTED BY (  CAST(( fadPrecio*(1-(CAST(fadDesc1 AS FLOAT)/100)) ) *(1-(CAST(fadDesc2 AS FLOAT)/100)) AS NUMERIC(14,2)));
ALTER TABLE FACTURADET ADD FADIMPORTE COMPUTED BY (CAST(fadPrecioDesc*fadCant AS NUMERIC(14,2)));
ALTER TABLE FACTURADET ADD FADIMPOIMPU1 COMPUTED BY (CAST(fadImporte*(CAST(fadImpu1 AS FLOAT)/100) AS NUMERIC(14,2)));
ALTER TABLE FACTURADET ADD FADIMPOIMPU2 COMPUTED BY (CAST(fadImporte*(CAST(fadImpu2 AS FLOAT)/100) AS NUMERIC(14,2)));
*/

/*
ALTER TABLE FACTURA ADD FAIMPORTE2 COMPUTED BY ( CAST(((faSuma*(1-(CAST(faDesc1 AS FLOAT)/100)))*(1-(CAST(faDesc2 AS FLOAT)/100)))*(1-(CAST(faDesc3 AS FLOAT)/100)) AS NUMERIC(14,2)));
ALTER TABLE FACTURA ADD FAIMPOIMPU2 COMPUTED BY (CAST(faImporte*(CAST(faImpu AS FLOAT)/100) AS NUMERIC(14,2)));
ALTER TABLE FACTURA ADD FATOTAL2 COMPUTED BY ( CAST(faImpoImpu+faImporte AS NUMERIC(14,2)) );
*/
/*
ALTER TABLE FACTURADET 
DROP FADIMPOIMPU12,
DROP FADIMPOIMPU22,
DROP FADIMPORTE2,
DROP FADPRECIODESC2
*/

ALTER TABLE FACTURA drop fatotal;
ALTER TABLE FACTURA drop faimpoimpu;
ALTER TABLE FACTURA drop faimporte;

ALTER TABLE FACTURA ADD FAIMPORTE COMPUTED BY ( CAST(((faSuma*(1-(CAST(faDesc1 AS FLOAT)/100)))*(1-(CAST(faDesc2 AS FLOAT)/100)))*(1-(CAST(faDesc3 AS FLOAT)/100)) AS NUMERIC(14,2)));
ALTER TABLE FACTURA ADD FAIMPOIMPU COMPUTED BY (CAST(faImporte*(CAST(faImpu AS FLOAT)/100) AS NUMERIC(14,2)));
ALTER TABLE FACTURA ADD FATOTAL COMPUTED BY ( CAST(faImpoImpu+faImporte AS NUMERIC(14,2)) );





/*
REGENERA FACTURAS ANTIGUAS.

insert into factura(
id, PEDIDO_ID, farefer, FAFECHA, FAPLAZO, FATIPO, FADIVISA, DIVISA_ID,
FAPRECIO, FAALMACEN, FAPEDIDO, FAST, FACVECLI, FATDA, CLIENTE_ID, FACVEVEN, 
VENDEDOR_ID, FACOMIS, FACVETRANS, FASUMA,
FADESC1, FADESC2, FADESC3,  FAIMPU,
faobser, FAT, CREUSR, CREFEC, MODUSR, MODFEC, FECENV, 
FACAJAS, FATALONEMB, FAFEMBARQUE, FAFENTREGA, FACANT, FATCAMBIO, 
FALEMPAQUE, FAOSURTIDO, FASIG, FASERIE, FATVTA, FADVORIG, FADVVTA, 
FATPOVTA, FACVEEMPRESA, FASERIEFOL, TRANSPORTE_ID, OLDST, oldrefer,oldfactura_id
)

SELECT gen_id(transaccion,1), a.PEDIDO_ID, 'D'||LPAD(gen_id(facturaid,1),7,'0') farefer, cast('2014-01-29' as timestamp) fafecha, a.FAPLAZO, a.FATIPO, a.FADIVISA, a.DIVISA_ID,
a.FAPRECIO, a.FAALMACEN, a.FAPEDIDO, a.FAST, a.FACVECLI, a.FATDA, a.CLIENTE_ID, a.FACVEVEN, 
a.VENDEDOR_ID, a.FACOMIS, a.FACVETRANS, a.FASUMA,
a.FADESC1, a.FADESC2, a.FADESC3, /*a.FAIMPORTE,*/ a.FAIMPU, /*a.FAIMPOIMPU, a.FATOTAL, */
trim(a.FAOBSER)||' (ant: '||a.farefer||')' faobser, a.FAT, a.CREUSR, a.CREFEC, a.MODUSR, a.MODFEC, a.FECENV, 
a.FACAJAS, a.FATALONEMB, a.FAFEMBARQUE, a.FAFENTREGA, a.FACANT, a.FATCAMBIO, 
a.FALEMPAQUE, a.FAOSURTIDO, a.FASIG, a.FASERIE, a.FATVTA, a.FADVORIG, a.FADVVTA, 
a.FATPOVTA, a.FACVEEMPRESA, a.FASERIEFOL, a.TRANSPORTE_ID, a.OLDST, a.farefer oldrefer,a.id oldfactura_id
FROM FACTURA a
where a.farefer>='D0000100' and a.farefer<='D0009999' and a.oldst='A' and a.fat=0
order by a.farefer;
commit;
*/


/*

insert into facturadet(
ID, factura_id,PEDIDO_ID, fadrefer, FADPEDIDO, FADCVEART, FADCOLOR, 
FADPRECIO,
FADT0, FADT1, FADT2, FADT3, FADT4, FADT5, FADT6, FADT7, FADT8, FADT9, 
FADDESC1, FADDESC2, FADIMPU1, FADIMPU2,
CREUSR, CREFEC, MODUSR, MODFEC,
FECENV, ARTICULO_ID, COLOR_ID, TALLA_ID,
OLDFACTURADET_ID
)

SELECT gen_id(transaccion,1), f.id, a.PEDIDO_ID, f.farefer, a.FADPEDIDO, a.FADCVEART, a.FADCOLOR, 
a.FADPRECIO,
a.FADT0, a.FADT1, a.FADT2, a.FADT3, a.FADT4, a.FADT5, a.FADT6, a.FADT7, a.FADT8, a.FADT9, 
 a.FADDESC1, a.FADDESC2, a.FADIMPU1, a.FADIMPU2,
a.CREUSR, a.CREFEC, a.MODUSR, a.MODFEC,
a.FECENV, a.ARTICULO_ID, a.COLOR_ID, a.TALLA_ID,
a.id OLDFACTURADET_ID
FROM FACTURADET a
join factura f on f.oldfactura_id=a.FACTURA_ID
where f.farefer>='D0001044' and f.farefer<='D0009999' and f.oldst='A' and f.fat=0
order by f.farefer;

commit;

commit;

*/