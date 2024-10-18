<?php

class SalvarImagemService
{
    /**
     * Processa e salva uma imagem em um diretório específico.
     * 
     * @param array $arquivoImagem O array $_FILES referente ao arquivo enviado.
     * @param string $tipo O tipo de imagem ('ingrediente' ou 'usuario').
     * @return string|null Retorna o nome do arquivo salvo ou null em caso de falha.
     */
    public function salvarImagem(array $arquivoImagem, string $tipo): ?string
    {
        // Verificar se o arquivo é válido
        if ($arquivoImagem['error'] === UPLOAD_ERR_OK) {
            // Obter a extensão do arquivo
            $extensao = pathinfo($arquivoImagem['name'], PATHINFO_EXTENSION);
            
            // Gerar um nome único para o arquivo
            $nomeArquivo = uniqid('img_', true) . '.' . $extensao;
            
            // Diretório base para uploads
            $diretorioBase = __DIR__ . '/../../uploads/';
            
            // Criar o diretório base se não existir
            if (!file_exists($diretorioBase)) {
                mkdir($diretorioBase, 0755, true);
            }
            
            // Definir o diretório com base no tipo
            switch ($tipo) {
                case 'ingrediente':
                    $diretorioDestino = $diretorioBase . 'ingredientes/';
                    break;
                case 'usuario':
                    $diretorioDestino = $diretorioBase . 'usuarios/';
                    break;
                default:
                    return null; // Tipo inválido
            }
            
            // Criar o diretório específico se não existir
            if (!file_exists($diretorioDestino)) {
                mkdir($diretorioDestino, 0755, true);
            }

            // Verificar se é realmente uma imagem
            $check = getimagesize($arquivoImagem['tmp_name']);
            if ($check !== false) {
                // Mover o arquivo para o diretório de destino
                if (move_uploaded_file($arquivoImagem['tmp_name'], $diretorioDestino . $nomeArquivo)) {
                    return $nomeArquivo; // Retorna o nome do arquivo salvo
                } else {
                    return null; // Falha ao mover o arquivo
                }
            } else {
                return null; // Arquivo não é uma imagem válida
            }
        }

        return null; // Erro no upload
    }
}
