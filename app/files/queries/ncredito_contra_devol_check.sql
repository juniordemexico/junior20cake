
select notas.ncrefer,notas.nccvecli,notas.nctda,
notas.ncfecha,notas.ncfecha_tolera,
devols.derefer,devols.decvecli,devols.detda,
notas.notas_firmas,devols.devols_firmas

from 
(
select n.ncrefer, n.nccvecli, n.nctda, n.ncfecha,cast(n.ncfecha+30 as timestamp) ncfecha_tolera,list(cast(extract(year from n.ncfecha) as varchar(4))||trim(n.nccvecli)||trim(n.nctda)||trim(nd.ncdcveart)||trim(nd.ncdcolor)||nd.ncdcant||
nd.ncdt0||nd.ncdt1||nd.ncdt2||nd.ncdt3||nd.ncdt4||nd.ncdt5||nd.ncdt6||nd.ncdt7||nd.ncdt8||nd.ncdt9) notas_firmas
from ncredito_open n
join ncreditodet_open nd on nd.ncdrefer=n.ncrefer
where n.ncfecha>='2013-01-01' and n.nctipo=0 and n.ncst='A' and (n.ncdevol is null or n.ncdevol='')
group by n.nccvecli,n.nctda,n.ncrefer,n.ncfecha,cast(n.ncfecha+30 as timestamp)
) notas
left join
(
select d.derefer, d.decvecli, d.detda, cast(d.defecha as timestamp) defecha, 
list(cast(extract(year from d.defecha) as varchar(4))||trim(d.decvecli)||trim(d.detda)||trim(dd.dedcveart)||trim(dd.dedcolor)||dd.dedcant||
dd.dedt0||dd.dedt1||dd.dedt2||dd.dedt3||dd.dedt4||dd.dedt5||dd.dedt6||dd.dedt7||dd.dedt8||dd.dedt9) devols_firmas
from devol_open d
join devoldet_open dd on dd.dedrefer=d.derefer
where d.defecha>='2013-01-01' and d.dest='A'
group by d.decvecli,d.detda,d.derefer,cast(d.defecha as timestamp)
) devols on devols.devols_firmas=notas.notas_firmas and (devols.defecha>=notas.ncfecha and  devols.defecha<=notas.ncfecha_tolera)

rows 500


{}

