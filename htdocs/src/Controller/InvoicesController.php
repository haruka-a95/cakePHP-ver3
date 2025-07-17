<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Invoices Controller
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 *
 * @method \App\Model\Entity\Invoice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InvoicesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $invoices = $this->paginate($this->Invoices);

        $this->set(compact('invoices'));
    }

    /**
     * View method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => []
        ]);

        $this->set('invoice', $invoice);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invoice = $this->Invoices->newEntity();
        if ($this->request->is('post')) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        $this->set(compact('invoice'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        $this->set(compact('invoice'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoice = $this->Invoices->get($id);
        if ($this->Invoices->delete($invoice)) {
            $this->Flash->success(__('The invoice has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function print($id)
    {
        $invoice = $this->Invoices->get($id);

         // DOMPDF を読み込む（配置した場所に応じてパスを調整）
        require_once(ROOT . DS . 'vendor' . DS . 'dompdf' . DS . 'autoload.inc.php');

        /// 自動のレイアウトを無効にする
        $this->viewBuilder()->layout(false);

        // テンプレート指定
        $this->viewBuilder()->template('pdf');

        // ビューに変数を渡す
        $this->set(compact('invoice'));

        $html = $this->render()->getBody();

        // DOMPDF インスタンス作成
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');//サイズ
        $dompdf->render();

        // PDF レスポンスを返す
        return $this->response
            ->withType('application/pdf')
            ->withStringBody($dompdf->output())
            ->withDownload("invoice_{$id}.pdf");//ファイル名
    }
}
