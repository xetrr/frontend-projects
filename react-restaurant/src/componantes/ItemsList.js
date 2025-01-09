import React from 'react';
import Card from 'react-bootstrap/Card';
import { Row,Col } from 'react-bootstrap';
import Fade from 'react-reveal/Fade';


export default function ItemsList({itemsdata}) {
  return (
    <Row>
        <Fade up>
            {
                itemsdata.length? itemsdata.map((item)=>{
                    return(
                            <Col key={item.id} sm = '12' className='mb-3'>
                        <Card className='d-flex flex-row p-1' style={{backgroundColor: '#f8f8f8'}}>
                            <Card.Img className='img-item' variant="top" src={item.img} />
                            <Card.Body>
                                <Card.Title className='d-flex justify-content-between' >
                                    <div className='item-title'>{item.title}</div>
                                    <div className='item-price'>{item.price}</div>
                                </Card.Title>
                                <Card.Text className='py-2'>
                                <div className='item-description'>{item.title} {item.title} {item.title} {item.title} {item.title} {item.title} {item.title}</div>
                                </Card.Text>
                            </Card.Body>
                        </Card>
                    </Col>
                    )
                })
                : <h3> no data</h3>
            }
        </Fade>         
    </Row>
  )
}
