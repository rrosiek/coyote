defmodule Coyote.Mail do
  @moduledoc """
  The Mail context.
  """

  import Ecto.Query, warn: false
  alias Coyote.Repo

  alias Coyote.Mail.Correspondence

  @doc """
  Returns the list of correspondence.

  ## Examples

      iex> list_correspondence()
      [%Correspondence{}, ...]

  """
  def list_correspondence do
    Repo.all(Correspondence)
  end

  @doc """
  Gets a single correspondence.

  Raises `Ecto.NoResultsError` if the Correspondence does not exist.

  ## Examples

      iex> get_correspondence!(123)
      %Correspondence{}

      iex> get_correspondence!(456)
      ** (Ecto.NoResultsError)

  """
  def get_correspondence!(id), do: Repo.get!(Correspondence, id)

  @doc """
  Creates a correspondence.

  ## Examples

      iex> create_correspondence(%{field: value})
      {:ok, %Correspondence{}}

      iex> create_correspondence(%{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def create_correspondence(attrs \\ %{}) do
    %Correspondence{}
    |> Correspondence.changeset(attrs)
    |> Repo.insert()
  end

  @doc """
  Updates a correspondence.

  ## Examples

      iex> update_correspondence(correspondence, %{field: new_value})
      {:ok, %Correspondence{}}

      iex> update_correspondence(correspondence, %{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def update_correspondence(%Correspondence{} = correspondence, attrs) do
    correspondence
    |> Correspondence.changeset(attrs)
    |> Repo.update()
  end

  @doc """
  Deletes a Correspondence.

  ## Examples

      iex> delete_correspondence(correspondence)
      {:ok, %Correspondence{}}

      iex> delete_correspondence(correspondence)
      {:error, %Ecto.Changeset{}}

  """
  def delete_correspondence(%Correspondence{} = correspondence) do
    Repo.delete(correspondence)
  end

  @doc """
  Returns an `%Ecto.Changeset{}` for tracking correspondence changes.

  ## Examples

      iex> change_correspondence(correspondence)
      %Ecto.Changeset{source: %Correspondence{}}

  """
  def change_correspondence(%Correspondence{} = correspondence) do
    Correspondence.changeset(correspondence, %{})
  end
end
