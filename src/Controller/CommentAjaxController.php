<?php

namespace Drupal\comtrans\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\comment\Entity\Comment;
use Drupal\comment\CommentInterface;
use Google\Cloud\Translate\TranslateClient;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller providing nodes to be fetched with Ajax.
 */
class CommentAjaxController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function content($cid = NULL) {

    $settings = \Drupal::config('comtrans.settings');

    $comment = Comment::load($cid);
    $data    = [
      'title' => '',
      'body'  => '',
    ];

    if ($comment instanceof CommentInterface) {

      // Get comment in current language.
      $comment = \Drupal::service('entity.repository')
        ->getTranslationFromContext($comment);

      if (!$comment->subject->isEmpty()) {
        $title         = $comment->subject->first()->getValue();
        $translation   = $this->translate($title, 'ja', $settings->get('google_api_key'));
        $data['title'] = $translation['text'];
      }

      if (!$comment->comment_body->isEmpty()) {
        $body         = $comment->comment_body->first()->getValue();
        $translation  = $this->translate($body, 'ja', $settings->get('google_api_key'));
        $data['body'] = $translation['text'];
      }

      // $serializer = \Drupal::service('serializer');
      // $data = $serializer->serialize($node, 'json', ['plugin_id' => 'entity']);
    }

    $response = new JsonResponse();
    $response->setData($data);
    return $response;
  }

  private function translate($text, $target_language, $api_key) {

    $translate      = new TranslateClient();
    $targetLanguage = $target_language;
    $result         = $translate->translate($text, [
      'target' => $targetLanguage,
      'key'    => $api_key,
    ]);
    return $result;
  }

}
