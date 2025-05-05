<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        // Validation de la requête
        $request->validate([
            'message' => 'required|string',
        ]);

        // Récupération du message de l'utilisateur
        $message = strtolower(trim($request->input('message')));

        // Vérifier si le chat vient juste de commencer ou si le cache a été vidé
        if (!Cache::has('chat_started')) {
            // Premier message - Accueil
            Cache::put('chat_started', true, now()->addMinutes(30)); // Expiration après 30 minutes

            return response()->json([
                'message' => "👋 Bonjour et bienvenue chez YANSOFT group ! Que puis-je faire pour vous aujourd'hui ?\n\n▸ Créer un site web\n▸ Développer une application mobile\n▸ Améliorer ma visibilité en ligne\n▸ Hébergement de mon site\n▸ Demander un conseil ou devis"
            ]);
        }

        // Réponses personnalisées après l'accueil
        if (str_contains($message, 'site web')) {
            return response()->json([
                'message' => "Quel type de site souhaitez-vous créer ?\n\n▸ Site vitrine\n▸ E-commerce\n▸ Blog / média\n▸ Autre"
            ]);
        }

        if (str_contains($message, 'vitrine') || str_contains($message, 'e-commerce') || str_contains($message, 'blog')) {
            return response()->json([
                'message' => "Avez-vous déjà un design ou une maquette ?\n\n▸ Oui\n▸ Non\n▸ J’ai besoin d’aide pour le design"
            ]);
        }

        if (str_contains($message, 'design') || str_contains($message, 'maquette')) {
            return response()->json([
                'message' => "Souhaitez-vous que nous prenions en charge l’hébergement ?\n\n▸ Oui\n▸ Non\n▸ Je ne sais pas encore"
            ]);
        }

        if (str_contains($message, 'application mobile')) {
            return response()->json([
                'message' => "Souhaitez-vous une application pour :\n\n▸ Android\n▸ iOS\n▸ Les deux\n▸ Je ne sais pas encore"
            ]);
        }

        if (str_contains($message, 'android') || str_contains($message, 'ios') || str_contains($message, 'les deux')) {
            return response()->json([
                'message' => "L’application est-elle destinée au grand public ou à un usage interne ?"
            ]);
        }

        if (str_contains($message, 'usage interne') || str_contains($message, 'grand public')) {
            return response()->json([
                'message' => "Avez-vous une idée des fonctionnalités principales ?\n\n▸ Oui, j’ai une idée claire\n▸ Non, j’ai besoin d’aide pour définir les fonctionnalités"
            ]);
        }

        if (str_contains($message, 'marketing') || str_contains($message, 'visibilité')) {
            return response()->json([
                'message' => "Quels sont vos objectifs marketing ?\n\n▸ Gagner en visibilité\n▸ Générer des leads\n▸ Fidéliser mes clients\n▸ Automatiser mes campagnes"
            ]);
        }

        if (str_contains($message, 'objectifs marketing')) {
            return response()->json([
                'message' => "Avez-vous déjà une stratégie ou une équipe marketing ?\n\n▸ Oui, mais on cherche à l’améliorer\n▸ Non, on part de zéro"
            ]);
        }

        if (str_contains($message, 'hébergement')) {
            return response()->json([
                'message' => "Avez-vous déjà un nom de domaine ou un hébergement ?\n\n▸ Oui\n▸ Non\n▸ Je ne sais pas"
            ]);
        }

        if (str_contains($message, 'nom de domaine') || str_contains($message, 'hébergement')) {
            return response()->json([
                'message' => "Souhaitez-vous que l’on gère la maintenance et les sauvegardes ?\n\n▸ Oui\n▸ Non\n▸ Je ne sais pas encore"
            ]);
        }

        if (str_contains($message, 'conseil') || str_contains($message, 'devis')) {
            return response()->json([
                'message' => "Souhaitez-vous parler à un expert ou répondre à quelques questions ?\n\n▸ Parler à un expert\n▸ Répondre à quelques questions"
            ]);
        }

        if (str_contains($message, 'expert') || str_contains($message, 'répondre')) {
            return response()->json([
                'message' => "Souhaitez-vous une estimation rapide pour votre projet ?\n\n▸ Oui\n▸ Non"
            ]);
        }

        if (str_contains($message, 'estimation')) {
            return response()->json([
                'message' => "Quel est votre budget approximatif pour ce projet ?\n\n▸ Moins de 1 000 €\n▸ Entre 1 000 € et 5 000 €\n▸ Entre 5 000 € et 10 000 €\n▸ Plus de 10 000 €\n▸ Je ne sais pas encore"
            ]);
        }

        if (str_contains($message, 'budget')) {
            return response()->json([
                'message' => "Dans quel délai souhaitez-vous que le projet soit livré ?\n\n▸ Moins d’un mois\n▸ 1 à 3 mois\n▸ Plus de 3 mois\n▸ Pas encore défini"
            ]);
        }

        if (str_contains($message, 'délai')) {
            return response()->json([
                'message' => "Avez-vous déjà un cahier des charges ou une idée claire des fonctionnalités ?\n\n▸ Oui, j’ai un cahier des charges\n▸ J’ai une idée générale\n▸ Non, j’ai besoin d’aide pour le définir"
            ]);
        }

        if (str_contains($message, 'cahier des charges')) {
            return response()->json([
                'message' => "Souhaitez-vous que l’on vous recontacte pour une estimation personnalisée ?\n\n▸ Oui, par mail\n▸ Oui, par téléphone\n▸ Non, je veux juste une idée rapide"
            ]);
        }

        // Réponse après "Oui" ou "Non"
        if (str_contains($message, 'oui') || str_contains($message, 'non')) {
            return response()->json([
                'message' => "Ok, pas de problème ! 😊 Pour continuer, merci de remplir le formulaire de contact ci-dessous pour que nous puissions vous recontacter.\n\n[Formulaire de contact]"
            ]);
        }

        // Réponse par défaut si aucune correspondance
        return response()->json([
            'message' => "Je n’ai pas bien compris votre demande. Pouvez-vous la reformuler ou choisir une option proposée ? 😊"
        ]);
    }
}
