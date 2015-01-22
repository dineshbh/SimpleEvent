<?php

class Trabalhos extends Eloquent  {
  /**
   * [$timestamps description]
   * @var boolean
   */
  public $timestamps = false;

  protected $guarded = ['id'];

  protected $destination;
  protected $data;

  /**
   * [$table description]
   * @var string
   */
  protected $table = 'z_evento_trabalhos_novo';

  public function createPaper($data)
  {
    unset($data['_token']);

    return Trabalhos::create($data) ? true : false;
  }

  public function fetchPapers($autorId)
  {
    $papers = $this->where('autor', '=', $autorId)->get();
    $papers = $this->fetchCoAuthors($papers);
    return $papers;
  }

  public function fetchCoAuthors($papers)
  {
    $total = count($papers);

    for ($i = 0; $i < $total; $i += 1) {
      $coAuthorsList = [
        $papers[$i]->co_autor_1,
        $papers[$i]->co_autor_2,
        $papers[$i]->co_autor_3,
        $papers[$i]->co_autor_4,
        $papers[$i]->co_autor_5
      ];
      $papers[$i]->coAuthors = $this->retrieveCoAuthors($coAuthorsList);
    }

    return $papers;
  }

  public function retrieveCoAuthors($coAuthorsList)
  {
    return User::select('nome')->whereIn('id', $coAuthorsList)->get();
  }

  /**
   * [HERE BE DRAGONS!!!! DON'T TOUCH BELOW THIS LINE]
   */

  /**
   * @param  [type] $destination [description]
   * @param  [type] $data        [description]
   * @return [type]              [description]
   */
  public function savePaper($destination, $data)
  {
    unset($data['_token']);
    $this->data = $data;
    $this->destination = $destination;

    $this->preparePapers(
      Input::file('arquivo_identificado')->getClientOriginalExtension()
    );

    return $this->movePaper() ? Trabalhos::create($this->data) : false;
  }

  /**
   * [movePaper description]
   * @param  [type] $data [description]
   * @return [type]       [description]
   */
  private function movePaper()
  {
    $main = Input::file('arquivo_identificado')
      ->move($this->destination, $this->data['arquivo_identificado']);
    $secondary = Input::file('arquivo_nao_identificado')
      ->move($this->destination, $this->data['arquivo_nao_identificado']);

    return ($main && $secondary);
  }

  private function preparePapers($extension)
  {
    $this->data['arquivo_identificado'] = $this->randomStringGenerator($this->data['autor'], $extension);
    $this->data['arquivo_nao_identificado'] = $this->randomStringGenerator($this->data['autor'], $extension);
  }

  /**
   * [randomStringGenerator description]
   * @return string random
   */
  private function randomStringGenerator($autor, $fileExtension)
  {
    return $autor . '-' . str_random(40) . '.' . $fileExtension;
  }
}