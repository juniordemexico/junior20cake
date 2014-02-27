
SELECT
IIF(a.tipoarticulo_id=0, 'COMPRA_VENTA', 'MATERIA_PRIMA') vc_tipo,
a.id vi_codigousuario,
cast(a.id as varchar(16))||'-'||cast(c.id as varchar(16)) vi_orden,
a.arcveart vc_nombrecorto,
trim(a.arcveart)||' - '||c.cve vc_nombre,
a.ardescrip vc_descripcion,
a.arobser vc_comentario,
a.arst vc_estatus,
'' vc_codigo_sku,
iif(a.arimpu1<>0,'SI', 'NO') vl_gravable,
iif(a.arimpu1=0,'SI', 'NO') vl_gravable,
'SI' vl_usa_lote,
'NO' vl_usa_pedimento,
'NO' vl_perecedero,
'NO' vl_es_kit,
'NO' vl_usa_serie,
'PIEZA' si_id_m_unidad,
'' reservado,
0 vd_costo,
a.arpva vd_precio,
'MXP' si_id_moneda,
'PRECIO A' LISTA_DE_PRECIOS,
l.licve linea,
m.macve marca,
te.tecve temporada,
a.lento lento_desplazamiento,
ac.color_id color_id,
c.cve color_clave,
t.tadescrip grupo_de_tallas,
replace(replace(t.tat0||', '||t.tat1||', '||t.TAT2||', '||t.TAT3||', '||t.TAT4||', '||
t.tat5||', '||t.tat6||', '||t.TAT7||', '||t.TAT8||', '||t.TAT9, ',,,,',''), ',,','') tallas_del_grupo,
p.cve grupo_proporciones_para_produccion
FROM articulo a
JOIN unidades u ON u.id=a.UNIDAD_ID
JOIN lineas l ON l.id=a.linea_id
JOIN marcas m ON m.id=a.marca_id
JOIN temporadas te ON te.id=a.temporada_id
JOIN tallas t ON t.id=a.talla_id
JOIN articulos_colores ac ON ac.articulo_id=a.id
JOIN colores c ON c.id=ac.color_id
LEFT JOIN proporciones p ON p.id=a.proporcion_id
WHERE a.tipoarticulo_id=0 AND a.arst='A' AND a.arlinea IN('PACA', 'PADA', 'CAMI') AND
a.arcveart NOT like '1%'
ORDER BY l.licve,a.arcveart,c.cve
rows 5000



SELECT
IIF(a.tipoarticulo_id=0, 'COMPRA_VENTA', 'MATERIA_PRIMA') vc_tipo,
a.id vi_codigousuario,
cast(a.id as varchar(16))||'-'||cast(c.id as varchar(16)) vi_orden,
a.arcveart vc_nombrecorto,
trim(a.arcveart)||' - '||c.cve vc_nombre,
a.ardescrip vc_descripcion,
a.arobser vc_comentario,
a.arst vc_estatus,
'' vc_codigo_sku,
iif(a.arimpu1<>0,'SI', 'NO') vl_gravable,
iif(a.arimpu1=0,'SI', 'NO') vl_gravable,
iif(a.arlinea='TELA','SI', 'NO') vl_usa_lote,
'NO' vl_usa_pedimento,
'NO' vl_perecedero,
'NO' vl_es_kit,
'NO' vl_usa_serie,
u.cve si_id_m_unidad,
'' reservado,
0 vd_costo,
0 vd_precio,
'MXP' si_id_moneda,
'COSTO' LISTA_DE_COSTOS,
l.licve linea,
m.macve marca,
/*te.tecve temporada, */
/*a.lento lento_desplazamiento,*/
ac.color_id color_id,
c.cve color_clave /*,*/
/*t.tadescrip grupo_de_tallas*/
/*
replace(replace(t.tat0||', '||t.tat1||', '||t.TAT2||', '||t.TAT3||', '||t.TAT4||', '||
t.tat5||', '||t.tat6||', '||t.TAT7||', '||t.TAT8||', '||t.TAT9, ',,,,',''), ',,','') tallas_del_grupo,
p.cve grupo_proporciones_para_produccion
*/
FROM articulo a
JOIN unidades u ON u.id=a.UNIDAD_ID
JOIN tallas t ON t.id=a.talla_id
LEFT JOIN lineas l ON l.id=a.linea_id
LEFT JOIN marcas m ON m.id=a.marca_id
LEFT JOIN temporadas te ON te.id=a.temporada_id
LEFT JOIN articulos_colores ac ON ac.articulo_id=a.id
LEFT JOIN colores c ON c.id=ac.color_id
/*LEFT JOIN proporciones p ON p.id=a.proporcion_id*/
WHERE a.tipoarticulo_id=1 AND a.arst='A' AND a.arlinea IN('HABI', 'TELA')
ORDER BY l.licve,a.arcveart,c.cve



--UNIDADES
select u.*
from unidades u
order by u.id

--LINEAS
select l.id,l.licve,l.descrip,l.tipoarticulo_id,l.created,l.modified 
from lineas l
order by l.id

--MARCAS
select m.id,m.macve,m.nom,m.GENERICA 
from marcas m
order by m.id

--TEMPORADAS
select t.id,t.tecve
from TEMPORADAS t
order by t.id

--TALLAS
select ta.id,ta.tacve,ta.tadescrip,ta.st,
ta.tat0,ta.tat1,ta.tat2,ta.tat3,ta.tat4,ta.tat5,ta.tat6,ta.tat7,ta.tat8,ta.tat9
from tallas ta
order by ta.id
