<?php

declare(strict_types=1);

namespace App\Controller;

use Aws\S3\S3Client;

class ProductsController extends AppController
{
    public array $paginate = [
        'limit' => 25, 
        'order' => [
            'Products.created' => 'DESC'
        ]
    ];

    public function index()
    {
        $this->set('products', $this->paginate($this->Products));
        $this->render('/products/index');
    }

    public function create()
    {
        $this->render('/products/create');
    }

    public function edit($id = null)
    {
        $product = $this->Products->get($id);

        $this->set('product', $product);
        $this->render('/products/edit');
    }

    public function store(S3Client $s3Client)
    {
        $product = $this->Products->newEmptyEntity();
        $product = $this->Products->patchEntity($product, $this->request->getData());

        foreach ($product->getErrors() as $field => $messages)
        {
            foreach ($messages as $message)
            {
                return $this->response->withType('application/json')
                                        ->withStringBody(json_encode([
                                            'status'  => 'error',
                                            'message' => str_replace('field', $field, $message)
                                        ]));
            }
        }

        
        // handle file upload to AWS
        $file = $this->request->getData('image');

        $file_name = $file->getClientFilename();
        $extension = substr($file_name, stripos($file_name, '.') + 1);  
        $random    = bin2hex(random_bytes(15));
        
        $s3_key = "{$random}.{$extension}"; 

        try {
            $result = $s3Client->putObject([
                'Bucket'     => 'cake-products-bucket',
                'Key'        => $s3_key,
                'SourceFile' => $file->getStream()->getMetadata('uri'),
                'ACL' => 'public-read'         
            ]);

            $product->image_url = $result['ObjectURL'];
            
        } catch (\Exception $e) 
        {
            return $this->response->withType('application/json')
                                    ->withStringBody(json_encode([
                                        'status'  => 'error',
                                        'message' => $e->getMessage()
                                    ]));
        }

        if (!$this->Products->save($product))
        {
            return $this->response->withType('application/json')
                                    ->withStringBody(json_encode([
                                        'status'  => 'error',
                                        'message' => 'Failed to save product.'
                                    ]));
        }


        return $this->response->withType('application/json')
                                ->withStringBody(json_encode([
                                    'status'  => 'success',
                                    'message' => 'New product has been saved.'
                                ]));
    }

    public function update()
    {
        $product = $this->Products->get($this->request->getData('id'));
        $product = $this->Products->patchEntity($product, $this->request->getData());

        foreach ($product->getErrors() as $field => $messages)
        {
            foreach ($messages as $message)
            {
                return $this->response->withType('application/json')
                                        ->withStringBody(json_encode([
                                            'status'  => 'error',
                                            'message' => str_replace('field', $field, $message)
                                        ]));
            }
        }


        if (!$this->Products->save($product)) 
        {
            return $this->response->withType('application/json')
                                    ->withStringBody(json_encode([
                                        'status'  => 'error',
                                        'message' => 'Failed to save product.'
                                    ]));
        }


        return $this->response->withType('application/json')
                                ->withStringBody(json_encode([
                                    'status'  => 'success',
                                    'message' => 'The product has been saved.'
                                ]));
    }
}
