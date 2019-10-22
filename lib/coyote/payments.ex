defmodule Coyote.Payments do
  @moduledoc """
  The Payments context.
  """

  import Ecto.Query, warn: false
  alias Coyote.Repo

  alias Coyote.Payments.Stripe

  @doc """
  Returns the list of payments.

  ## Examples

      iex> list_payments()
      [%Stripe{}, ...]

  """
  def list_payments do
    Repo.all(Stripe)
  end

  @doc """
  Gets a single stripe.

  Raises `Ecto.NoResultsError` if the Stripe does not exist.

  ## Examples

      iex> get_stripe!(123)
      %Stripe{}

      iex> get_stripe!(456)
      ** (Ecto.NoResultsError)

  """
  def get_stripe!(id), do: Repo.get!(Stripe, id)

  @doc """
  Creates a stripe.

  ## Examples

      iex> create_stripe(%{field: value})
      {:ok, %Stripe{}}

      iex> create_stripe(%{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def create_stripe(attrs \\ %{}) do
    %Stripe{}
    |> Stripe.changeset(attrs)
    |> Repo.insert()
  end

  @doc """
  Updates a stripe.

  ## Examples

      iex> update_stripe(stripe, %{field: new_value})
      {:ok, %Stripe{}}

      iex> update_stripe(stripe, %{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def update_stripe(%Stripe{} = stripe, attrs) do
    stripe
    |> Stripe.changeset(attrs)
    |> Repo.update()
  end

  @doc """
  Deletes a Stripe.

  ## Examples

      iex> delete_stripe(stripe)
      {:ok, %Stripe{}}

      iex> delete_stripe(stripe)
      {:error, %Ecto.Changeset{}}

  """
  def delete_stripe(%Stripe{} = stripe) do
    Repo.delete(stripe)
  end

  @doc """
  Returns an `%Ecto.Changeset{}` for tracking stripe changes.

  ## Examples

      iex> change_stripe(stripe)
      %Ecto.Changeset{source: %Stripe{}}

  """
  def change_stripe(%Stripe{} = stripe) do
    Stripe.changeset(stripe, %{})
  end
end
