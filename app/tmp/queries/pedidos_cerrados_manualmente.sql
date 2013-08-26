select p.id,p.perefer,substring(cast(p.pefecha as varchar(24)) from 1 for 10) fecha, substring(cast(p.pefvence as varchar(24)) from 1 for 10) vence,cast(p.petotal as numeric(12,2)) total,v.vecveven,c.clcvecli,c.cltda,
p.pest,
p.pesurtido,(select first 1 fapedido from factura where fapedido=p.perefer and fast='A') factura,
substring(cast(p.pefauto as varchar(24)) from 1 for 10) fautoriza,p.crefec,p.modfec,p.modusr
FROM pedido p
JOIN clientes c ON c.id=p.cliente_id
JOIN vendedores v ON V.ID=p.vendedor_id
WHERE p.pefecha>='2013/01/01' AND p.peST<>'C' and p.pesurtido=1 and
p.perefer <> (coalesce((select first 1 fapedido from factura where p.perefer=fapedido and fast='A'),''))
order by p.pefecha,c.clcvecli,c.cltda
ROWS 500
